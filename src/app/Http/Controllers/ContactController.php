<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * 入力画面表示
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * 確認画面表示
     */
    public function confirm(Request $request)
    {
        // ✅ バリデーション（見本の機能構造ルールに準拠）
        $validated = $request->validate([
            'name'       => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'tel1'       => 'required|digits_between:1,4',
            'tel2'       => 'required|digits_between:1,4',
            'tel3'       => 'required|digits_between:1,4',
            'body'       => 'required|string|max:1000',
        ], [
            'name.required'  => 'お名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email'    => '有効なメールアドレスを入力してください。',
            'tel1.required'  => '電話番号を入力してください。',
            'tel2.required'  => '電話番号を入力してください。',
            'tel3.required'  => '電話番号を入力してください。',
            'body.required'  => 'お問い合わせ内容を入力してください。',
        ]);

        // ✅ 確認画面で1つの電話番号として表示できるよう結合
        $tel = $validated['tel1'] . $validated['tel2'] . $validated['tel3'];

        // ✅ 入力内容をセッションに保存（戻ったときに保持）
        $request->session()->put('contact_input', $validated + ['tel' => $tel]);

        return view('contact.confirm', [
            'input' => $validated,
            'tel'   => $tel,
        ]);
    }

    /**
     * 送信処理（確認画面 → 完了画面）
     */
    public function send(Request $request)
    {
        // セッションから入力情報を取得
        $input = $request->session()->get('contact_input');

        if (!$input) {
            return redirect()->route('contact.index');
        }

        // ✅ データベース保存（モデル：App\Models\Contact）
        Contact::create([
            'name'  => $input['name'],
            'email' => $input['email'],
            'tel'   => $input['tel1'] . $input['tel2'] . $input['tel3'],
            'body'  => $input['body'],
        ]);

        // ✅ セッションクリア
        $request->session()->forget('contact_input');

        return view('contact.thanks');
    }

    /**
     * 管理画面一覧（既存維持）
     */
    public function adminIndex()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.index', compact('contacts'));
    }
}
