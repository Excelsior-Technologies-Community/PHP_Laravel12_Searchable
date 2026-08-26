<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $sort = $request->sort ?? 'oldest';

        $posts = Post::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        })
            ->when($sort == 'newest', function ($query) {
                $query->latest();
            })
            ->when($sort == 'oldest', function ($query) {
                $query->oldest();
            })
            ->paginate(5);

        $totalPosts = Post::count();

        $searchResultsCount = Post::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        })
            ->count();

        $recentPosts = Post::latest()
            ->take(5)
            ->get();

        return view('search.index', compact(
            'posts',
            'search',
            'sort',
            'totalPosts',
            'searchResultsCount',
            'recentPosts'
        ));
    }

    public function searchSpatie(Request $request)
    {
        $searchTerm = $request->input('search');

        $searchResults = (new Search)
            ->registerModel(Post::class, ['title', 'content'])
            ->search($searchTerm);

        $posts = $searchResults->map(fn ($result) => $result->searchable);

        return view('search.index', compact('posts', 'searchTerm'));
    }

    public function liveSearch(Request $request): JsonResponse
    {
        $searchTerm = trim($request->input('q', ''));

        if ($searchTerm === '') {
            return response()->json(['results' => []]);
        }

        $searchResults = (new Search)
            ->registerModel(Post::class, ['title', 'content'])
            ->search($searchTerm);

        $results = $searchResults->map(function ($result) {
            $post = $result->searchable;

            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => \Str::limit(strip_tags($post->content), 80),
                'url' => route('posts.show', $post->id),
            ];
        })->take(5);

        return response()->json([
            'results' => $results,
            'total' => $searchResults->count(),
        ]);
    }

    public function create()
    {
        return view('search.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Post::create($request->only('title', 'content'));

        return redirect('/')
            ->with('success', 'Post created successfully');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('search.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('search.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);

        $post->update($request->only('title', 'content'));

        return redirect('/')
            ->with('success', 'Post updated successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect('/')
            ->with('success', 'Post deleted successfully');
    }

    public function export(Request $request)
    {
        $search = $request->search;

        $posts = Post::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        })
            ->get();

        $response = new StreamedResponse(function () use ($posts) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'ID',
                'Title',
                'Content',
                'Created Date',
            ]);

            foreach ($posts as $post) {
                fputcsv($handle, [
                    $post->id,
                    $post->title,
                    $post->content,
                    $post->created_at,
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="posts.csv"');

        return $response;
    }
}
