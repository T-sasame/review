<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//ログイン情報を参照する為、Authの定義
use Illuminate\Support\Facades\Auth;
//モデルの定義
use App\Review;
//AWS S3を使用する為の定義
use Storage;

class ReviewController extends Controller
{
    public function add()
    {
        return view('admin.review.create');
    }

    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Review::$rules);

        $review = new Review;
        $form = $request->all();

        // フォームから画像が送信されてきたら保存して、$review->image_path に画像のパスを保存する
        if (isset($form['image'])) {
          $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
          $review->image_path = Storage::disk('s3')->url($path);
        } else {
            $review->image_path = null;
        }

        //ログインしたidと名前をreviewsテーブルのuser_id,user_nameに格納する
        $user = Auth::user();
        $review->user_id = $user->id;
        $review->user_name = $user->name;

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $review->fill($form);
        $review->save();

        return redirect('admin/review/');
    }

    public function mypage(Request $request)
    {
        $user = Auth::user();
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            //ログインした際のidを参照することで、投稿したレビューのみを表示

            //自分の投稿したレビューの中から検索結果を取得する
            $posts = Review::where('title', 'LIKE', "%{$cond_title}%")->where('user_id', $user->id)->get();
        } else {
            //それ以外は自分の投稿したレビューを全て取得する
            $posts = Review::where('user_id', $user->id)->get();
        }
        return view('admin.review.mypage', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
        //モデルからデータを取得する
        $review = Review::find($request->id);
        if (empty($review)) {
            abort(404);
        }
        return view('admin.review.edit', ['review_form' => $review]);
    }


    public function update(Request $request)
    {
        //バリデーションをかける
        $this->validate($request, Review::$rules);
        //モデルからデータを取得する
        $review = Review::find($request->id);
        //送信されてきたフォームデータを格納する
        $review_form = $request->all();
        //画像の変更を保存、削除ならばnullにする
        if ($request->input('remove')) {
            $review_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = Storage::disk('s3')->putFile('/',$review_form['image'],'public');
            $review_form['image_path'] = Storage::disk('s3')->url($path);
        } else {
            $review_form['image_path'] = $review->image_path;
        }

        unset($review_form['_token']);
        unset($review_form['image']);
        unset($review_form['remove']);

        //該当するデータを上書きして保存する
        $review->fill($review_form)->save();

        return redirect('admin/review');
    }

    public function delete(Request $request)
    {
        //該当するモデルを取得
        $review = Review::find($request->id);
        //削除する
        $review->delete();
        return redirect('admin/review/');
    }
}
