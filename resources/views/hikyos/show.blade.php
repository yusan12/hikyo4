@extends('layouts.app')
@section('content')
@inject('comment_service', 'App\Services\CommentService')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts.flash-message')
            <h3>{{ $hikyo->name }}</h3>
        </div>
        <div class="col-md-10 mb-3">
            <a href="{{ route('hikyos.index') }}" class="btn btn-primary">秘境一覧に戻る</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 mb-5">
            @foreach ($hikyo->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{ $loop->iteration }} {{ $comment->user->name }} {{ $comment->created_at }}</p>
                    <p class="mb-0">{!! $comment_service->convertUrl($comment->body) !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h5 class="card-header">コメントする</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('comments.store', $hikyo->id) }}" class="mb-4">
                        @csrf
                        <div class="form-group">
                            <label for="hikyo-first-content">内容</label>
                            <textarea name="body" class="form-control" id="hikyo-first-content" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">書き込む</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
