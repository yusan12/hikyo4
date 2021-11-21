@inject('comment_service', 'App\Services\CommentService')
@inject('image_service', 'App\Services\ImageService')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts.flash-comment')
            <h3>{{ $hikyo->name }}</h3>
        </div>
        <div class="col-md-10 mb-3">
            <a href="{{ route('hikyos.index') }}" class="btn btn-primary">掲示板に戻る</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10 mb-5">
            @foreach ($hikyo->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{ $loop->iteration }} {{ $comment->user->name }} {{ $comment->created_at }}</p>
                    <p class="mb-0">{!! $comment_service->convertUrl($comment->body) !!}</p>
                    <div class="row">
                        @if (!$comment->images->isEmpty())
                        @foreach ($comment->images as $image)
                            <div class="col-md-3">
                                <img src="{{ $image_service->createTemporaryUrl($image->s3_file_path) }}" class="img-thumbnail" alt="">
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h5 class="card-header">レスを投稿する</h5>
                <div class="card-body">
                    @include('components.comment-create', compact('hikyo'))
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
