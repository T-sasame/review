{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- main.blade.phpの@yield('title')に埋め込む --}}
@section('title', 'レビューの新規作成')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>レビューの新規作成</h2>
                <form action="{{ action('Admin\ReviewController@create') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">ジャンル</label>
                        <div class="col-md-10">
                            <ul class="genre">
                                <li><input type="radio" name="genre" value='RPG' {{ old('genre') == 'RPG' ? 'checked' : '' }}>RPG</li>
                                <li><input type="radio" name="genre" value='アクション' {{ old('genre') == 'アクション' ? 'checked' : '' }}>アクション</li>
                                <li><input type="radio" name="genre" value='シューティング' {{ old('genre') == 'シューティング' ? 'checked' : '' }}>シューティング</li>
                                <li><input type="radio" name="genre" value='シミュレーション' {{ old('genre') == 'シミュレーション' ? 'checked' : '' }}>シミュレーション</li>
                                <li><input type="radio" name="genre" value='アドベンチャー' {{ old('genre') == 'アドベンチャー' ? 'checked' : '' }}>アドベンチャー</li>
                                <li><input type="radio" name="genre" value='対戦格闘' {{ old('genre') == '対戦格闘' ? 'checked' : '' }}>対戦格闘</li>
                                <li><input type="radio" name="genre" value='スポーツ' {{ old('genre') == 'スポーツ' ? 'checked' : '' }}>スポーツ</li>
                                <li><input type="radio" name="genre" value='その他' {{ old('genre') == 'その他' ? 'checked' : '' }}>その他</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">点数</label>
                        <div class="col-md-10">
                            <input type="number" name="score" min="0" max="100" value="{{ old('score') }}">　※半角数字の0~100で入力してください
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="review">レビュー</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="review" rows="15">{{ old('review') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection
