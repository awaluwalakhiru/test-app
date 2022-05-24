@extends('layouts.main')
@section('content')

<main class="py-4">
    <div class="container mt-1">
        @if (session('flash_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> {{ session('flash_message') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('post.create',['userId'=>Auth::user()->id]) }}" class="btn btn-primary">Buat
                        Post</a>
                </div>
            </div>
        </div>

        @if ($posts->count()<=0) <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Tak ada Postingan</h5>
                        <p class="card-text">Pada user ini !!!</p>
                    </div>
                </div>
            </div>
    </div>
    @endif

    <div class="row mt-3">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card text-center">
                <div class="card-header">
                    Title : {{ $post->title }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Slug:</h5>
                    <p class="card-text">{{ $post->slug }}</p>
                    <p class="card-text">Content: </p>
                    <p class="card-text">{{ $post->content }}</p>
                    <a href="{{ route('post.edit',['postId'=>$post->id]) }}" class="btn btn-success">Edit Post</a>
                    <a href="{{ route('post.delete',['postId'=>$post->id]) }}" class="btn btn-danger">Delete Post</a>
                    <a href="{{ route('comment.create',['postId'=>$post->id,'userId'=>Auth::user()->id??0]) }}"
                        class="btn btn-primary">Create
                        Comment</a>
                </div>
                <div class="card-footer text-muted">
                    <p>
                        Email {{ $post->user->email }}
                        <br>
                        By {{ $post->user->name }} At {{ date('m-d-Y',strtotime($post->created_at)) }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-3">
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>

    </div>
</main>
@endsection