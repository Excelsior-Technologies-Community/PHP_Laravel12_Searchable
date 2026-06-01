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

        <a href="/posts/create" class="btn btn-primary px-4">
            + Create Post
        </a>

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

                    <div class="col-md-10">

                        <input
                            type="text"
                            name="search"
                            class="form-control bg-secondary border-0 text-white"
                            placeholder="Search title or content..."
                            value="{{ request('search') }}">

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

    {{-- Posts Table --}}
    <div class="card border-0 shadow-lg bg-dark text-white">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-dark table-hover align-middle mb-0">

                    <thead class="table-secondary text-dark">

                        <tr>

                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($posts as $post)

                        <tr>

                            <td>
                                {{ $post->id }}
                            </td>

                            <td class="fw-semibold">
                                {{ $post->title }}
                            </td>

                            <td>
                                {{ Str::limit($post->content, 70) }}
                            </td>

                            <td>
                                {{ $post->created_at->format('d M Y') }}
                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    {{-- View Button --}}
                                    <a
                                        href="{{ route('posts.show', $post->id) }}"
                                        class="btn btn-success btn-sm">

                                        View

                                    </a>

                                    {{-- Delete Button --}}
                                    <form
                                        action="{{ route('posts.destroy', $post->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <div class="text-danger fw-bold">

                                    No Posts Found

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Custom Pagination --}}
    @if ($posts->hasPages())

        <div class="d-flex justify-content-center mt-4">

            <nav>

                <ul class="pagination pagination-sm">

                    {{-- Previous --}}
                    @if ($posts->onFirstPage())

                        <li class="page-item disabled">

                            <span class="page-link bg-dark border-secondary text-light">

                                &laquo;

                            </span>

                        </li>

                    @else

                        <li class="page-item">

                            <a
                                class="page-link bg-dark border-secondary text-light"
                                href="{{ $posts->previousPageUrl() }}">

                                &laquo;

                            </a>

                        </li>

                    @endif

                    {{-- Numbers --}}
                    @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)

                        <li class="page-item {{ $page == $posts->currentPage() ? 'active' : '' }}">

                            <a
                                class="page-link
                                {{ $page == $posts->currentPage()
                                    ? 'bg-primary border-primary text-white'
                                    : 'bg-dark border-secondary text-light' }}"
                                href="{{ $url }}">

                                {{ $page }}

                            </a>

                        </li>

                    @endforeach

                    {{-- Next --}}
                    @if ($posts->hasMorePages())

                        <li class="page-item">

                            <a
                                class="page-link bg-dark border-secondary text-light"
                                href="{{ $posts->nextPageUrl() }}">

                                &raquo;

                            </a>

                        </li>

                    @else

                        <li class="page-item disabled">

                            <span class="page-link bg-dark border-secondary text-light">

                                &raquo;

                            </span>

                        </li>

                    @endif

                </ul>

            </nav>

        </div>

    @endif

</div>

@endsectio