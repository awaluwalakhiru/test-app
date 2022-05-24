@extends('layouts.main')
@section('content')



<main class="py-4">
    <div class="container mt-1">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat! {{ session('status') }}</strong> Anda telah keluar aplikasi kami.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('flash_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> {{ session('flash_message') }}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        <div class="row justify-content-center mt-3">
            @foreach ($comments as $comment)
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">
                        {{ $comment->name }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $comment->email }}</p>
                        <p class="card-text">{{ $comment->website }}</p>
                        <p class="card-text">{{ $comment->comment }}</p>
                        <a href="{{ route('comment.create',['postId'=>$comment->post->id,'userId'=>Auth::user()->id??0]) }}"
                            class="btn btn-primary">Create
                            Comment</a>
                    </div>
                    <div class="card-footer text-muted">
                        {{ date('m-d-Y',strtotime($comment->created_at)) }}
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-3">
                {{ $comments->onEachSide(1)->links() }}
            </div>
        </div>

    </div>
</main>
@endsection