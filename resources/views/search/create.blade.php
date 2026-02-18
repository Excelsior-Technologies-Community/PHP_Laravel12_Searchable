@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="max-w-4xl mx-auto px-6 mt-12">

    <div class="bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-semibold mb-6">Create New Post</h2>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-medium">Title</label>
                <input type="text" name="title"
                       class="w-full border rounded px-4 py-2" required>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium">Content</label>
                <textarea name="content" rows="5"
                          class="w-full border rounded px-4 py-2" required></textarea>
            </div>

            <button class="bg-indigo-600 text-white px-6 py-2 rounded">
                Save Post
            </button>
        </form>
    </div>

</div>
@endsection
