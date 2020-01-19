{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- main.blade.phpの@yield('title')に埋め込む --}}
@section('title', 'レビューの新規作成')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <h2>レビューの新規作成</h2>
                <form action="{{ action('Admin\ReviewController@create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li style="color:red; list-style-type: none;">{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="title">タイトル<span style="color: gray;">(必須)</span></label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="rev_title">
                        </div>
                        <div class="rev_error col-md-12" id="error_title"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">ジャンル<span style="color: gray;">(必須)</span></label>
                        <div class="genre col-md-10">
                            <ul>
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
                        <div class="rev_error col-md-12" id="error_genre"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">ハード<span style="color: gray;">(必須)</span></label>
                        <div class="hard col-md-10">
                            <ul>
                                <li><input type="radio" name="hard" value='PS4/PS3' {{ old('hard') == 'PS4/PS3' ? 'checked' : '' }}>PS4/PS3</li>
                                <li><input type="radio" name="hard" value='Nintendo Switch' {{ old('hard') == 'Nintendo Switch' ? 'checked' : '' }}>Nintendo Switch</li>
                                <li><input type="radio" name="hard" value='Xbox One/360' {{ old('hard') == 'Xbox One/360' ? 'checked' : '' }}>Xbox One/360</li>
                                <li><input type="radio" name="hard" value='PS Vita/PSP' {{ old('hard') == 'PS Vita/PSP' ? 'checked' : '' }}>PS Vita/PSP</li>
                                <li><input type="radio" name="hard" value='Nintendo 3DS/DS' {{ old('hard') == 'Nintendo 3DS/DS' ? 'checked' : '' }}>Nintendo 3DS/DS</li>
                                <li><input type="radio" name="hard" value='PC' {{ old('hard') == 'PC' ? 'checked' : '' }}>PC</li>
                                <li><input type="radio" name="hard" value='スマホ' {{ old('hard') == 'スマホ' ? 'checked' : '' }}>スマホ</li>
                                <li><input type="radio" name="hard" value='その他' {{ old('hard') == 'その他' ? 'checked' : '' }}>その他</li>
                            </ul>
                        </div>
                        <div class="rev_error col-md-12" id="error_hard"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">点数<span style="color: gray;">(必須)</span></label>
                        <div class="col-md-10">
                            <input type="number" name="score" min="0" max="100" value="{{ old('score') }}" id="rev_score">
                            半角数字で入力してください
                            <div id="error_score" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="review">レビュー<span style="color: gray;">(必須)</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="review" rows="15" id="rev_review">{{ old('review') }}</textarea>
                        </div>
                        <div class="rev_error col-md-12" id="error_review"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">画像の投稿</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="レビューを投稿">
                </form>
            </div>
        </div>
    </div>
@endsection
