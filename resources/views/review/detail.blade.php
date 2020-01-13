{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に埋め込む --}}
@section('title', 'レビュー詳細ページ')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-4">
                        <div class="caption mx-auto">
                            <div class="image">
                                @if ($review->image_path)
                                    <img src="{{ $review->image_path }}">                                 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="review-field col-md-8">
                        <div class="title">
                            <h1>{{ $review->title }}</h1>
                        </div>
                        <p class="user_name mx-auto">投稿者: {{ $review->user_name }}</p>
                        <p class="genre mx-auto">ジャンル: {{ $review->genre }}</p>
                        <p class="score mx-auto">点数: {{ $review->score }}</p>
                        <p class="review mx-auto">{{ $review->review }}</p>
                        <div class="date">
                            <p>初回投稿日: {{ $review->created_at->format('Y年m月d日') }}</p>
                            <p>最終編集日: {{ $review->updated_at->format('Y年m月d日') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
