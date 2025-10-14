<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 🚨 ContactRequest, Contact, Category モデル/リクエストをインポート
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * お問い合わせ入力画面を表示（GET /）
     */
    public function index()
    {
        // 🚨 DB接続エラーやテーブル不足が500の原因となる箇所
        // Category::all() が成功すれば / の500エラーは解消します。
        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }

    /**
     * 確認画面を表示（POST /confirm）
     */
    public function confirm(ContactRequest $request)
    {
        // ContactRequestでバリデーションされたデータを取得
        $input = $request->validated();

        // 電話番号を結合
        $input['tel'] = "{$input['tel1']}-{$input['tel2']}-{$input['tel3']}";

        // カテゴリIDからカテゴリ名を取得
        $category = Category::find($input['category_id']);
        $input['category_content'] = $category ? $category->content : '不明';

        return view('contact.confirm', compact('input'));
    }

    /**
     * 確認画面から入力画面へ戻る処理（POST /confirm の back）
     */
    public function back(Request $request)
    {
        // withInput()でデータを保持したまま入力画面に戻る
        return redirect()->route('contact.index')->withInput($request->except(['_token', 'back']));
    }

    /**
     * データを保存し、完了画面へリダイレクト（POST /thanks）
     */
    public function store(Request $request)
    {
        // 保存に必要なデータのみを取得
        $input = $request->except(['_token']);

        // データベースに保存
        Contact::create($input);

        // 二重送信防止のためGETルートへリダイレクト
        return redirect()->route('contact.thanks');
    }

    /**
     * 完了画面を表示（GET /thanks）
     */
    public function thanks()
    {
        return view('contact.thanks');
    }
}
