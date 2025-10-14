<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 認証は不要
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // お名前
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            // 性別
            'gender' => ['required', 'integer', 'in:1,2,3'],
            // メールアドレス
            'email' => ['required', 'string', 'email', 'max:255'],
            // 電話番号（3つのパート）
            'tel1' => ['required', 'string', 'max:5', 'regex:/^[0-9]+$/'],
            'tel2' => ['required', 'string', 'max:5', 'regex:/^[0-9]+$/'],
            'tel3' => ['required', 'string', 'max:5', 'regex:/^[0-9]+$/'],
            // 住所・建物名
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            // お問い合わせ種類
            // ★existsルール: categoriesテーブルのid列に存在する値か確認
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            // お問い合わせ内容
            'detail' => ['required', 'string', 'max:120'], // 120文字制限
        ];
    }

    /**
     * バリデーションエラーメッセージのカスタマイズ
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 共通
            'required' => ':attributeは必須です。',
            'string' => ':attributeを文字列で入力してください。',
            'max' => ':attributeは:max文字以下で入力してください。',
            'integer' => ':attributeは数値で選択してください。',

            // 個別
            'email.email' => '有効なメールアドレス形式を入力してください。',
            'gender.in' => '性別の値が不正です。',
            'tel1.regex' => '電話番号は半角数字で入力してください。',
            'tel2.regex' => '電話番号は半角数字で入力してください。',
            'tel3.regex' => '電話番号は半角数字で入力してください。',
            'category_id.exists' => '選択されたお問い合わせの種類は無効です。',
        ];
    }

    /**
     * 属性名の日本語化
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'last_name' => 'お名前(姓)',
            'first_name' => 'お名前(名)',
            'gender' => '性別',
            'email' => 'メールアドレス',
            'tel1' => '電話番号',
            'tel2' => '電話番号',
            'tel3' => '電話番号',
            'address' => '住所',
            'building' => '建物名',
            'category_id' => 'お問い合わせの種類',
            'detail' => 'お問い合わせ内容',
        ];
    }
}
