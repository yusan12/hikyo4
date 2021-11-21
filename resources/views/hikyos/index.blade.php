@inject('comment_service', 'App\Services\CommentService')
@inject('image_service', 'App\Services\ImageService')

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('layouts.flash-message')
            {{ $hikyos->links() }}
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($hikyos as $hikyo)
            <div class="col-md-10 mb-5">
                <div class="card text-left">
                    <div class="card-header">
                        <h3><span class="badge badge-primary">{{ $hikyo->comments->count() }} <small>レス</small></span></h3>
                        <h3 class="m-0">{{ $hikyo->name }}</h3>
                    </div>
                    @foreach ($hikyo->comments as $comment)
                    @if ($loop->index >= 5)
                        @continue
                    @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $loop->iteration }} 名前：{{ $comment->user->name }}：{{ $comment->created_at }}</h5>
                            <p class="card-text">{!! $comment_service->convertUrl($comment->body) !!}</p>
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
                    @endforeach
                    <div class="card-footer">
                        @include('components.comment-create', compact('hikyo'))
                        <a href="{{ route('hikyos.show', $hikyo->id) }}">全部読む</a>
                        <a href="{{ route('hikyos.show', $hikyo->id) }}">最新50</a>
                        <a href="{{ route('hikyos.show', $hikyo->id) }}">1-100</a>
                        <a href="{{ route('hikyos.index') }}">リロード</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h5 class="card-header">新規スレッド作成</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('hikyos.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="hikyo-title">スレッドタイトル</label>
                            <input name="name" type="text" class="form-control" id="hikyo-title" placeholder="タイトル"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="hikyo-first-content">内容</label>
                            <textarea name="content" class="form-control" id="hikyo-first-content" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">スレッド作成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
