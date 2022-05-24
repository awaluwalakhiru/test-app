@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Selamat! {{ session('status') }}</strong> Anda telah masuk aplikasi kami.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
            </div>
        </div>
    </div>
</div>
@endsection