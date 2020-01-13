{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に埋め込む --}}
@section('title', 'レビューサイト')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <form action="{{ action('MainController@index') }}" method="get">
            <div class="form-group row">
                <h1 class="col-md-4">投稿レビュー一覧</h1>
                <label class="col-md-2">タイトル名で検索→</label>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
                </div>
                <div class="col-md-1">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="検索">
                </div>
            </div>
        </form>
        <hr color="#c0c0c0">
        @if (!is_null($posts))
            @foreach($posts as $post)
                <div class="row">
                    <div class="posts col-md-10 mx-auto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="caption mx-auto">
                                    <div class="image">
                                        @if ($post->image_path)
                                            <img src="{{ $post->image_path }}">
                                        @else
                                            <img src="{{ asset('storage/image/no_image.png') }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="review-field col-md-8">
                                <div class="title">
                                    <h1>{{ Str::limit($post->title, 100) }}</h1>
                                </div>
                                <p class="user_name mx-auto">投稿者: {{ Str::limit($post->user_name, 100) }}</p>
                                <p class="genre mx-auto">ジャンル: {{ Str::limit($post->genre, 50) }}</p>
                                <p class="score mx-auto">点数: {{ Str::limit($post->score, 5) }}</p>
                                <p class="review mx-auto">{{ Str::limit($post->review, 1000) }}</p>

                                {{-- 文字数制限に引っ掛かった場合は、詳細ページのリンクを表示 --}}
                                @if ( mb_strlen($post->title) > 50 || mb_strlen($post->review) > 500)
                                    <a href="{{ action('MainController@detail', ['id' => $post->id]) }}" role="button" class="btn btn-primary">詳細ページへ</a>
                                @elseif ( strlen($post->title) > 100 || strlen($post->review) > 1000)
                                    <a href="{{ action('MainController@detail', ['id' => $post->id]) }}" role="button" class="btn btn-primary">詳細ページへ</a>
                                @endif
                                <div class="date">
                                    <p>初回投稿日: {{ $post->created_at->format('Y年m月d日') }}</p>
                                    <p>最終編集日: {{ $post->updated_at->format('Y年m月d日') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr color="#c0c0c0">
            @endforeach
        {{-- laravelのページネーションを使用して、ページ分割をしている --}}
        {{ $posts->links() }}
        @endif
    </div>
@endsection
