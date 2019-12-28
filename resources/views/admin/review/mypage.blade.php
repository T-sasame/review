{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- main.blade.phpの@yield('title')に埋め込む --}}
@section('title', 'マイページ')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <h2>投稿レビュー一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\ReviewController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <form action="{{ action('Admin\ReviewController@mypage') }}" method="get">
                    <div class="form-group row">
                        <label class="col-md-2">タイトル名で検索→</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-review col-md-12 mx-auto">
                <div class="row">
                    <table class="table" border="2" >
                        <thead>
                            <tr>
                                <th width="20%">タイトル</th>
                                <th width="40%">レビュー</th>
                                <th width="10%">ジャンル</th>
                                <th width="10%">点数</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $review)
                                <tr>
                                    <td>{{ Str::limit($review->title, 100) }}</td>
                                    <td>{{ Str::limit($review->review, 250) }}</td>
                                    <td>{{ Str::limit($review->genre, 50) }}</td>
                                    <td>{{ Str::limit($review->score, 5) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\ReviewController@edit', ['id' => $review->id]) }}">編集</a>
                                        </div>
                                        <div>
                                            <a href="{{ action('Admin\ReviewController@delete', ['id' => $review->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
