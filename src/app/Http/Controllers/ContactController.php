<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * お問い合わせ入力ページ表示
     */
    public function index()
    {
        // カテゴリー一覧（セレクトボックス用）
        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }

    /**
     * 確認ページ表示
     */
    public function confirm(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'last_name'   => 'required|string|max:255',
            'first_name'  => 'required|string|max:255',
            'gender'      => 'required|in:1,2,3',
            'email'       => 'required|email|max:255',
            'tel'         => 'required|string|max:20',
            'address'     => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'detail'      => 'required|string|max:120',
        ]);

        // 入力内容を保持して確認ページへ
        return view('contact.confirm', compact('validated'));
    }

    /**
     * サンクスページ表示 + データ保存
     */
    public function thanks(Request $request)
    {
        // hiddenで受け取る全データを保存
        $contact = new Contact();
        $contact->fill($request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]));
        $contact->save();

        return view('contact.thanks');
    }
}
