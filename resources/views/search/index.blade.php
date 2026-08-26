@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold text-white">
                Laravel Search Dashboard
            </h2>

            <p class="text-secondary">
                Manage searchable posts professionally
            </p>
        </div>

        <div class="d-flex gap-2">

            {{-- Export CSV Button --}}
            <a href="{{ route('posts.export', ['search' => request('search')]) }}"
                class="btn btn-success px-3">

                <i class="bi bi-download"></i>
                Export CSV

            </a>

            {{-- Create Post Button --}}
            <a href="/posts/create" class="btn btn-primary px-4">
                + Create Post
            </a>

        </div>

    </div>

    {{-- Dashboard Card --}}
    <div class="card shadow-lg border-0 mb-4 bg-dark text-white">

        <div class="card-body p-4">

            <h6 class="text-secondary">
                Total Posts
            </h6>

            <h1 class="fw-bold">
                {{ $totalPosts }}
            </h1>

        </div>

    </div>

    {{-- Success Message --}}
    @if(session('success'))

    <div class="alert alert-success border-0 shadow-sm">

        {{ session('success') }}

    </div>

    @endif

    {{-- Search Box --}}
    <div class="card border-0 shadow-lg bg-dark mb-4">

        <div class="card-body p-4">

            <form action="/" method="GET">

                <div class="row g-3">

                    <div class="col-md-7">

                        <input
                            type="text"
                            name="search"
                            class="form-control bg-secondary border-0 text-white"
                            placeholder="Search title or content..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select
                            name="sort"
                            class="form-control bg-secondary border-0 text-white">

                            <option value="oldest"
                                {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                Oldest First
                            </option>

                            <option value="newest"
                                {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                Newest First
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2 d-grid">

                        <button class="btn btn-primary">
                            Search
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Search Result Count --}}
    @if($search)

    <div class="alert alert-info border-0 shadow-sm">

        Found
        <strong>{{ $searchResultsCount }}</strong>
        result(s) for

        <strong>"{{ $search }}"</strong>

    </div>

    @endif

    {{-- Posts List --}}
    <div class="d-grid gap-3 mb-4">

        @forelse($posts as $post)

            <x-search-result :post="$post" />

        @empty

            <div class="text-center py-5">

                <div class="text-danger fw-bold">
                    No Posts Found
                </div>

            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if ($posts->hasPages())

        <div class="d-flex justify-content-center">

            {{ $posts->appends(request()->query())->links('pagination::bootstrap-5') }}

        </div>

    @endif

</div>

@endsection