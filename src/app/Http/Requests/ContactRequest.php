<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name'      => 'required|string|max:50',
            'first_name'     => 'required|string|max:50',
            'gender'         => 'required|integer|in:1,2,3',
            'email'          => 'required|email|max:100',
            'tel1'           => 'required|numeric|digits_between:2,5',
            'tel2'           => 'required|numeric|digits_between:1,5',
            'tel3'           => 'required|numeric|digits_between:3,4',
            'address'        => 'required|string|max:200',
            'building'       => 'nullable|string|max:200',
            'category_id'    => 'required|integer|exists:categories,id',
            'detail'         => 'required|string|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel1.required'        => '電話番号を入力してください',
            'tel2.required'        => '電話番号を入力してください',
            'tel3.required'        => '電話番号を入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'detail.required'      => 'お問い合わせ内容を入力してください',
            'detail.max'           => 'お問合せ内容は120文字以内で入力してください',
        ];
    }

    /**
     * tel1/tel2/tel3 を結合して tel を作る（バリデーションの前に実行される）
     */
    protected function prepareForValidation()
    {
        if ($this->filled(['tel1', 'tel2', 'tel3'])) {
            $this->merge([
                'tel' => $this->tel1 . '-' . $this->tel2 . '-' . $this->tel3,
            ]);
        }
    }
}
