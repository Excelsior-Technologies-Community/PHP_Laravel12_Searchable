<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $posts = Post::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        })
        ->oldest()
        ->paginate(3);

        $totalPosts = Post::count();

        return view('search.index', compact('posts', 'search', 'totalPosts'));
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

        return redirect('/')->with('success', 'Post created successfully');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('search.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect('/')->with('success', 'Post deleted successfully');
    }
}