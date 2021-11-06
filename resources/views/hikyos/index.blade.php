@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @include('layouts.flash-message')
            <div class="card">
                <h5 class="card-header">新規秘境作成</h5>
                <div class="card-body">
                    <form method="POST" action="{{ route('hikyos.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="hikyo-title">秘境タイトル</label>
                            <input name="name" type="text" class="form-control" id="hikyo-title"
                                placeholder="タイトル">
                        </div>
                        <div class="form-group">
                            <label for="hikyo-place">秘境住所</label>
                            <input name="place" type="text" class="form-control" id="hikyo-place"
                                placeholder="住所">
                        </div>
                        <div class="form-group">
                            <label for="hikyo-introduction">秘境紹介</label>
                            <input name="introduction" type="text" class="form-control" id="hikyo-introduction"
                                placeholder="紹介文">
                        </div>
                        <div class="form-group">
                            <label for="hikyo-time_from_tokyo">東京からのかかる時間</label>
                            <input name="time_from_tokyo" type="text" class="form-control" id="hikyo-time_from_tokyo"
                                placeholder="○時間△分">
                        </div>
                        <div class="form-group">
                            <label for="hikyo-how_much_from_tokyo">東京からのかかる費用</label>
                            <input name="how_much_from_tokyo" type="text" class="form-control" id="hikyo-how_much_from_tokyo"
                                placeholder="￥1,2345">
                        </div>
                        <div class="form-group">
                            <label for="hikyo-caution">注意点</label>
                            <input name="caution" type="text" class="form-control" id="hikyo-caution"
                                placeholder="列車を一本乗り過ごすと2時間待ち。注意！">
                        </div>
                        <div class="form-group">
                            <label for="hikyo-first-content">内容</label>
                            <textarea name="content" class="form-control" id="hikyo-first-content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">秘境作成</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
