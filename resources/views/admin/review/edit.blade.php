{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- main.blade.phpの@yield('title')に埋め込む --}}
@section('title', '投稿レビューの編集')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>レビューの編集</h2>
                <form action="{{ action('Admin\ReviewController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $review_form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">ジャンル</label>
                        <div class="col-md-10">
                            <ul class="genre">
                                {{-- 新規投稿の際にチェックされた項目を、デフォルトでチェック状態にする --}}
                                <li><input type="radio" name="genre" value='RPG' {{ $review_form->genre == 'RPG' ? 'checked' : '' }}>RPG</li>
                                <li><input type="radio" name="genre" value='アクション' {{ $review_form->genre == 'アクション' ? 'checked' : '' }}>アクション</li>
                                <li><input type="radio" name="genre" value='シューティング' {{ $review_form->genre == 'シューティング' ? 'checked' : '' }}>シューティング</li>
                                <li><input type="radio" name="genre" value='シミュレーション' {{ $review_form->genre == 'シミュレーション' ? 'checked' : '' }}>シミュレーション</li>
                                <li><input type="radio" name="genre" value='アドベンチャー' {{ $review_form->genre == 'アドベンチャー' ? 'checked' : '' }}>アドベンチャー</li>
                                <li><input type="radio" name="genre" value='対戦格闘' {{ $review_form->genre == '対戦格闘' ? 'checked' : '' }}>対戦格闘</li>
                                <li><input type="radio" name="genre" value='スポーツ' {{ $review_form->genre == 'スポーツ' ? 'checked' : '' }}>スポーツ</li>
                                <li><input type="radio" name="genre" value='その他' {{ $review_form->genre == 'その他' ? 'checked' : '' }}>その他</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">点数</label>
                        <div class="col-md-10">
                            <input type="number" name="score" min="0" max="100" value="{{ $review_form->score }}">　※半角数字の0~100で入力してください
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="review">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="review" rows="15">{{ $review_form->review }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-text text-info">
                                設定中: {{ $review_form->image_path }}
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $review_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
