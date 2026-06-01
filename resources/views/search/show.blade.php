@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-lg custom-dark-card">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <div class="view-icon mb-3">

                            <i class="bi bi-file-earmark-text-fill"></i>

                        </div>

                        <h2 class="fw-bold text-white">

                            {{ $post->title }}

                        </h2>

                        <p class="text-secondary">

                            Posted on
                            {{ $post->created_at->format('d M Y') }}

                        </p>

                    </div>

                    <div class="content-box">

                        <p class="content-text">

                            {{ $post->content }}

                        </p>

                    </div>

                    <div class="text-center mt-5">

                        <a href="/" class="btn back-btn">

                            <i class="bi bi-arrow-left-circle-fill"></i>

                            Back to Dashboard

                        </a>

                    </div>

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

    .view-icon{
        width: 85px;
        height: 85px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
        font-size: 34px;
        color: white;
        box-shadow: 0 10px 30px rgba(37,99,235,0.35);
    }

    .content-box{
        background: #09090b;
        border: 1px solid #27272a;
        border-radius: 20px;
        padding: 30px;
        margin-top: 30px;
    }

    .content-text{
        color: #d4d4d8;
        font-size: 17px;
        line-height: 1.9;
        margin-bottom: 0;
    }

    .back-btn{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: none;
        border-radius: 16px;
        padding: 14px 28px;
        color: white;
        font-weight: 600;
        transition: 0.3s;
    }

    .back-btn:hover{
        transform: translateY(-2px);
        opacity: 0.95;
        color: white;
    }

</style>

@endsectio