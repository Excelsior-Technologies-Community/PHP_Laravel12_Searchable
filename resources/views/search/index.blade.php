@extends('layouts.app')

@section('title', 'Search Posts')

@section('content')
<div class="max-w-5xl mx-auto px-6 mt-12">

    <!-- Search Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">
            Search Posts
        </h2>

        <form action="{{ route('search') }}" method="GET" class="flex gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Type keywords..."
                class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                required
            >
            <button
                type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition"
            >
                Search
            </button>
        </form>
    </div>

    <!-- Results -->
    @if(isset($searchResults))
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">
                Search Results
            </h3>

            @forelse($searchResults as $result)
                <div class="bg-white rounded-lg shadow p-5 mb-4 hover:shadow-md transition">
                    <a href="{{ $result->url }}"
                       class="text-indigo-600 font-medium text-lg hover:underline">
                        {{ $result->title }}
                    </a>
                </div>
            @empty
                <div class="bg-white p-6 rounded shadow text-gray-500 text-center">
                    No matching records found.
                </div>
            @endforelse
        </div>
    @endif

</div>
@endsection
