@props(['post'])

<div class="search-result-item" data-id="{{ $post->id }}">
    <div class="search-result-content">
        <h5 class="search-result-title">{{ \Str::limit($post->title, 60) }}</h5>
        <p class="search-result-snippet">
            {{ \Str::limit(strip_tags($post->content), 120) }}
        </p>
        <div class="search-result-meta">
            <span class="search-result-date">
                <i class="bi bi-calendar3 me-1"></i>
                {{ $post->created_at->format('M d, Y') }}
            </span>
        </div>
    </div>
    <div class="search-result-actions">
        <a
            href="{{ route('posts.show', $post->id) }}"
            class="btn btn-sm btn-success">
            <i class="bi bi-eye"></i> View
        </a>
        <a
            href="{{ route('posts.edit', $post->id) }}"
            class="btn btn-sm btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <form
            action="{{ route('posts.destroy', $post->id) }}"
            method="POST"
            class="d-inline">
            @csrf
            @method('DELETE')
            <button
                type="submit"
                class="btn btn-sm btn-danger"
                onclick="return confirm('Delete this post?')">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
</div>

<style>
    .search-result-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem 1.5rem;
        border-radius: 16px;
        background: #18181b;
        border: 1px solid #27272a;
        transition: transform 0.15s, background 0.15s;
    }

    .search-result-item:hover {
        background: #1e1e26;
        transform: translateY(-1px);
    }

    .search-result-content {
        flex: 1;
        min-width: 0;
    }

    .search-result-title {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 0.35rem;
    }

    .search-result-snippet {
        color: #a1a1aa;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .search-result-meta {
        color: #71717a;
        font-size: 0.78rem;
    }

    .search-result-actions {
        display: flex;
        gap: 0.4rem;
        flex-wrap: nowrap;
    }
</style>
