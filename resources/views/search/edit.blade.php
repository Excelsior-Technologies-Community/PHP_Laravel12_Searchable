@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card border-0 shadow-lg custom-dark-card">

                <div class="card-body p-5">

                    <div class="text-center mb-5">

                        <div class="icon-box mb-3">

                            <i class="bi bi-pencil-square"></i>

                        </div>

                        <h2 class="fw-bold text-white">
                            Edit Post
                        </h2>

                        <p class="text-secondary">
                            Update your post content
                        </p>

                    </div>

                    <form
                        action="{{ route('posts.update', $post->id) }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-4">

                            <label class="form-label text-light fw-semibold mb-2">

                                Post Title

                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ $post->title }}"
                                class="form-control custom-input"
                                placeholder="Enter post title">

                        </div>

                        <div class="mb-4">

                            <label class="form-label text-light fw-semibold mb-2">

                                Post Content

                            </label>

                            <textarea
                                name="content"
                                rows="6"
                                class="form-control custom-input"
                                placeholder="Write post content here...">{{ $post->content }}</textarea>

                        </div>

                        <div class="d-flex gap-3 d-grid">

                            <a
                                href="/"
                                class="btn btn-outline-secondary">
                                Cancel
                            </a>

                            <button class="btn custom-btn">

                                <i class="bi bi-check-circle-fill"></i>
                                Update Post
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

    .custom-dark-card{
        background: #18181b;
        border-radius: 28px;
        border: 1px solid #27272a;
    }

    .icon-box{
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        font-size: 32px;
        color: white;
        box-shadow: 0 10px 30px rgba(245,158,11,0.4);
    }

    .custom-input{
        background: #09090b;
        border: 1px solid #3f3f46;
        color: white;
        border-radius: 16px;
        padding: 14px 18px;
    }

    .custom-input:focus{
        background: #09090b;
        color: white;
        border-color: #a855f7;
        box-shadow: 0 0 0 4px rgba(168,85,247,0.15);
    }

    .custom-input::placeholder{
        color: #71717a;
    }

    .custom-btn{
        background: linear-gradient(135deg, #9333ea, #7e22ce);
        border: none;
        border-radius: 16px;
        padding: 14px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
    }

    .custom-btn:hover{
        transform: translateY(-2px);
        opacity: 0.95;
    }

</style>

@endsection
