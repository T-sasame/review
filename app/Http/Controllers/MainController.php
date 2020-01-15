<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//モデルの定義
use App\Review;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        //$cond_titleが空白でない場合は、記事を検索して取得する
        //LIKEを使用することで、部分検索が可能
        //paginateメソッドを使用して、自動でページを分割する
        if ($cond_title != '') {
            $posts = Review::where('title', 'LIKE', "%{$cond_title}%")->orderBy('score', 'desc')->paginate(3);
        } else {
            //表示のソートがされた場合は$sortにリクエストを格納
            $sort = $request->sort;
            switch ($sort) {
                case 'new':
                    $posts = Review::orderBy('created_at', 'desc')->paginate(3);
                    break;
                case 'desc':
                    $posts = Review::orderBy('score', 'desc')->paginate(3);
                    break;
                case 'asc':
                    $posts = Review::orderBy('score', 'asc')->paginate(3);
                    break;
                default:
                    $posts = Review::orderBy('score', 'desc')->paginate(3);
            }
        }

        //review/index.blade.php ファイルを渡している
        //またViewテンプレートにposts、cond_titleという変数を渡している
        return view('review.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function detail(Request $request)
    {
        //モデルからデータを取得する
        $review = Review::find($request->id);
        if (empty($review)) {
            abort(404);
        }
        return view('review.detail', ['review' => $review]);
    }

    public function new_user()
    {
        return view('auth.register');
    }
}
