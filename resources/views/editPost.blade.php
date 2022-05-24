@extends('layouts.main')
@section('content')
<main class="py-4">
    <div class="container mt-3">
        <div class="row justify-content-center d-none">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@yield('title_content')</div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <form action="{{ route('post.update') }}" method="post">
                @csrf
                <div class="row justify-content-center">
                    <div class="mb-3 form-group col-md-8">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                    </div>
                    <div class="mb-3 form-group col-md-8">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" class="form-control" id="content" cols="30"
                            rows="5">{{ $post->content }}</textarea>
                        <input type="text" class="form-control hidden" name="user_id" value="{{ Auth::user()->id }}"
                            readonly>
                        <input type="text" class="form-control hidden" name="post_id" value="{{ $post->id }}" readonly>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-3">
            </div>
        </div>

    </div>
</main>
@endsection