{{-- layouts/front.blade.phpを読み込む --}}
@extends('layouts.front')


{{-- front.blade.phpの@yield('title')に埋め込む --}}
@section('title', 'レビューサイト')

{{-- main.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <form action="{{ action('MainController@index') }}" method="get">
            <div class="form-group row">
                <h1 class="col-md-6" style="text-align: center">投稿レビュー一覧</h1>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}" placeholder="検索したいタイトル名を入力して下さい">
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
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="review-field col-md-8">
                                <table class="style_table">
                                    <tbody>
                                        <tr>
                                            <th>作品名</th>
                                            <td>{{ Str::limit($post->title, 100) }}</td>
                                        </tr>
                                        <tr>
                                            <th>投稿者</th>
                                            <td>{{ Str::limit($post->user_name, 100) }}</td>
                                        </tr>
                                        <tr>
                                            <th>ジャンル</th>
                                            <td>{{ $post->genre }}</td>
                                        </tr>
                                        <tr>
                                            <th>ハード</th>
                                            <td>{{ $post->hard }}</td>
                                        </tr>
                                        <tr>
                                            <th>点数</th>
                                            <td>{{ $post->score }}</td>
                                        </tr>
                                        <tr>
                                            <th height="142px">レビュー</th>
                                            <td>{{ Str::limit($post->review, 1000) }}</td>
                                        </tr>
                                        <tr>
                                            <th>投稿日</th>
                                            <td>初回投稿日: {{ $post->created_at->format('Y年m月d日') }} 最終編集日: {{ $post->updated_at->format('Y年m月d日') }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- 文字数制限に引っ掛かった場合は、詳細ページのリンクを表示 --}}
                                @if ( mb_strlen($post->title) > 50 || mb_strlen($post->review) > 500)
                                    <div class="detail_button">
                                        <a href="{{ action('MainController@detail', ['id' => $post->id]) }}" role="button" class="btn btn-primary">詳細ページへ</a>
                                    </div>
                                @elseif ( strlen($post->title) > 100 || strlen($post->review) > 1000)
                                    <div class="detail_button">
                                        <a href="{{ action('MainController@detail', ['id' => $post->id]) }}" role="button" class="btn btn-primary">詳細ページへ</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr color="#c0c0c0">
            @endforeach
        {{-- laravelのページネーションを使用して、ページ分割をしている --}}
        {{-- appends(request()->input()) を追記することで、2ページ目以降にもパラメータを渡している --}}

        {{ $posts->appends(request()->input())->links() }}
        @endif
    </div>
@endsection
