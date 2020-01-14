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
                        <table class="style_table">
                            <tbody>
                                <tr>
                                    <th>作品名</th>
                                    <td>{{ $review->title }}</td>
                                </tr>
                                <tr>
                                    <th>投稿者</th>
                                    <td>{{ $review->user_name }}</td>
                                </tr>
                                <tr>
                                    <th>ジャンル</th>
                                    <td>{{ $review->genre }}</td>
                                </tr>
                                <tr>
                                    <th>点数</th>
                                    <td>{{ $review->score }}</td>
                                </tr>
                                <tr>
                                    <th>レビュー</th>
                                    <td>{{ $review->review }}</td>
                                </tr>
                                <tr>
                                    <th>投稿日</th>
                                    <td>初回投稿日: {{ $review->created_at->format('Y年m月d日') }} 最終編集日: {{ $review->updated_at->format('Y年m月d日') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
