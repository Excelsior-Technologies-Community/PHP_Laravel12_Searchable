<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Post;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
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

    \App\Models\Post::create($request->only('title', 'content'));

    return redirect('/')->with('success', 'Post created successfully');
}


    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Post::class, ['title', 'content'])
            ->search($request->search);

        return view('search.index', compact('searchResults'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('search.show', compact('post'));
    }
}
