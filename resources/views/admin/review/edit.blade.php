{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- main.blade.phpの@yield('title')に埋め込む --}}
@section('title', '投稿レビューの編集')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <h2>レビューの編集</h2>
                <form action="{{ action('Admin\ReviewController@update') }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" name="title" value="{{ $review_form->title }}" id="rev_title">
                        </div>
                        <div class="rev_error col-md-12" id="error_title"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">ジャンル<span style="color: gray;">(必須)</span></label>
                        <div class="genre col-md-10">
                            <ul>
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
                        <div class="rev_error col-md-12" id="error_genre"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">ハード<span style="color: gray;">(必須)</span></label>
                        <div class="hard col-md-10">
                            <ul>
                                <li><input type="radio" name="hard" value='PS4/PS3' {{ $review_form->hard == 'PS4/PS3' ? 'checked' : '' }}>PS4/PS3</li>
                                <li><input type="radio" name="hard" value='Nintendo Switch' {{ $review_form->hard == 'Nintendo Switch' ? 'checked' : '' }}>Nintendo Switch</li>
                                <li><input type="radio" name="hard" value='Xbox One/360' {{ $review_form->hard == 'Xbox One/360' ? 'checked' : '' }}>Xbox One/360</li>
                                <li><input type="radio" name="hard" value='PS Vita/PSP' {{ $review_form->hard == 'PS Vita/PSP' ? 'checked' : '' }}>PS Vita/PSP</li>
                                <li><input type="radio" name="hard" value='Nintendo 3DS/DS' {{ $review_form->hard == 'Nintendo 3DS/DS' ? 'checked' : '' }}>Nintendo 3DS/DS</li>
                                <li><input type="radio" name="hard" value='PC' {{ $review_form->hard == 'PC' ? 'checked' : '' }}>PC</li>
                                <li><input type="radio" name="hard" value='スマホ' {{ $review_form->hard == 'スマホ' ? 'checked' : '' }}>スマホ</li>
                                <li><input type="radio" name="hard" value='その他' {{ $review_form->hard == 'その他' ? 'checked' : '' }}>その他</li>
                            </ul>
                        </div>
                        <div class="rev_error col-md-12" id="error_hard"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="title">点数<span style="color: gray;">(必須)</span></label>
                        <div class="col-md-10">
                            <input type="number" name="score" min="0" max="100" value="{{ $review_form->score }}" id="rev_score">
                            半角数字で入力してください
                            <div id="error_score" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="review">レビュー<span style="color: gray;">(必須)</span></label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="review" rows="15" id="rev_review">{{ $review_form->review }}</textarea>
                        </div>
                        <div class="rev_error col-md-12" id="error_review"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="image">画像の投稿</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                </label>
                            </div>
                            <div class="image_edit text-info">
                              設定中: <img src="{{ $review_form->image_path }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $review_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="レビューの更新">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
