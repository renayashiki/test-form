<?php

return [
  /*
    |--------------------------------------------------------------------------
    | バリデーション言語行
    |--------------------------------------------------------------------------
    |
    | 以下の言語行はバリデータクラスで使用されるデフォルトのエラーメッセージです。
    | これらのルールの一部にはサイズルールのように複数のバージョンがあります。
    | ここで自由に各メッセージを調整してください。
    |
    */

  'accepted'             => ':attribute を承認してください。',
  'active_url'           => ':attribute は有効なURLではありません。',
  'after'                => ':attribute には :date 以降の日付を指定してください。',
  'after_or_equal'       => ':attribute には :date 以降または同日の日付を指定してください。',
  'alpha'                => ':attribute にはアルファベットのみ使用できます。',
  'alpha_dash'           => ':attribute には英数字、ハイフン、アンダースコアのみ使用できます。',
  'alpha_num'            => ':attribute には英数字のみ使用できます。',
  'array'                => ':attribute には配列を指定してください。',
  'before'               => ':attribute には :date 以前の日付を指定してください。',
  'before_or_equal'      => ':attribute には :date 以前または同日の日付を指定してください。',
  'between'              => [
    'numeric' => ':attribute には :min から :max までの数値を指定してください。',
    'file'    => ':attribute には :min KBから :max KBまでのファイルを指定してください。',
    'string'  => ':attribute は :min 文字から :max 文字の間で入力してください。',
    'array'   => ':attribute の項目は :min 個から :max 個でなければなりません。',
  ],
  'boolean'              => ':attribute には true か false を指定してください。',
  'confirmed'            => ':attribute が確認用フィールドと一致しません。',
  'date'                 => ':attribute には有効な日付を指定してください。',
  'date_format'          => ':attribute の形式は :format と一致しません。',
  'different'            => ':attribute と :other には異なる値を指定してください。',
  'digits'               => ':attribute は :digits 桁で入力してください。',
  'digits_between'       => ':attribute は :min 桁から :max 桁の間で入力してください。',
  'email'                => ':attribute は有効なメールアドレス形式で入力してください。',
  'filled'               => ':attribute の値は必須です。',
  'gt' => [
    'numeric' => ':attribute は :value より大きい値にしてください。',
    'file'    => ':attribute は :value KBより大きいファイルにしてください。',
    'string'  => ':attribute は :value 文字より長くしてください。',
    'array'   => ':attribute の項目数は :value より多くしてください。',
  ],
  'gte' => [
    'numeric' => ':attribute は :value 以上にしてください。',
    'file'    => ':attribute は :value KB以上のファイルにしてください。',
    'string'  => ':attribute は :value 文字以上で入力してください。',
    'array'   => ':attribute の項目数は :value 個以上でなければなりません。',
  ],
  'image'                => ':attribute には画像ファイルを指定してください。',
  'in'                   => '選択された :attribute は正しくありません。',
  'integer'              => ':attribute には整数を指定してください。',
  'max'                  => [
    'numeric' => ':attribute には :max 以下の数値を指定してください。',
    'file'    => ':attribute には :max KB以下のファイルを指定してください。',
    'string'  => ':attribute は :max 文字以内で入力してください。',
    'array'   => ':attribute の項目は :max 個以下でなければなりません。',
  ],
  'min'                  => [
    'numeric' => ':attribute には :min 以上の数値を指定してください。',
    'file'    => ':attribute には :min KB以上のファイルを指定してください。',
    'string'  => ':attribute は :min 文字以上で入力してください。',
    'array'   => ':attribute の項目は :min 個以上でなければなりません。',
  ],
  'not_in'               => '選択された :attribute は正しくありません。',
  'numeric'              => ':attribute には数値を指定してください。',
  'required'             => ':attribute は必須です。',
  'same'                 => ':attribute と :other が一致しません。',
  'size'                 => [
    'numeric' => ':attribute は :size を指定してください。',
    'file'    => ':attribute は :size KBでなければなりません。',
    'string'  => ':attribute は :size 文字で入力してください。',
    'array'   => ':attribute の項目は :size 個でなければなりません。',
  ],
  'string'               => ':attribute には文字を指定してください。',
  'unique'               => 'この :attribute は既に使用されています。',
  'url'                  => ':attribute の形式が正しくありません。',

  /*
    |--------------------------------------------------------------------------
    | カスタム属性名
    |--------------------------------------------------------------------------
    | 以下では、バリデーションメッセージで表示される :attribute プレースホルダを
    | よりわかりやすい名前に変換します。
    |
    */
  'attributes' => [
    'email' => 'メールアドレス',
    'password' => 'パスワード',
    'password_confirmation' => 'パスワード（確認）',
    'name' => 'お名前',
  ],
];



return [
    'required' => ':attributeを入力してください。',
    'email' => ':attributeの形式が正しくありません。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。',
    ],
    'confirmed' => ':attributeが確認欄と一致しません。',
    'attributes' => [
        'name' => 'お名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],
];
