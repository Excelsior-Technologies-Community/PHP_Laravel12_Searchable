@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto px-6 mt-12">

    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">
            {{ $post->title }}
        </h1>

        <p class="text-gray-700 leading-relaxed text-lg">
            {{ $post->content }}
        </p>

        <div class="mt-8">
            <a href="/"
               class="inline-block bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                ← Back to Search
            </a>
        </div>
    </div>

</div>
@endsection
