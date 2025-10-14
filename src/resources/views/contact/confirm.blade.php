@extends('layouts.guest')

@section('title', 'お問い合わせ確認')

@section('content')
    <h2 class="contact-title">Confirm</h2>
    
    <!-- フォームアクション: DB保存処理へPOST -->
    <form action="{{ route('contact.thanks') }}" method="POST" class="contact-form confirm-form">
        @csrf

        <!-- 1. お名前 -->
        <div class="form-group confirm-group">
            <label>お名前</label>
            <div class="form-field-wrapper">
                <p class="confirm-value">{{ $input['last_name'] }} {{ $input['first_name'] }}</p>
                <!-- hiddenフィールドで値を引き継ぎ -->
                <input type="hidden" name="last_name" value="{{ $input['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $input['first_name'] }}">
            </div>
        </div>

        <!-- 2. 性別 -->
        <div class="form-group confirm-group">
            <label>性別</label>
            <div class="form-field-wrapper">
                @php
                    $genderText = ['1' => '男性', '2' => '女性', '3' => 'その他'][$input['gender']] ?? '不明';
                @endphp
                <p class="confirm-value">{{ $genderText }}</p>
                <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            </div>
        </div>

        <!-- 3. メールアドレス -->
        <div class="form-group confirm-group">
            <label>メールアドレス</label>
            <div class="form-field-wrapper">
                <p class="confirm-value">{{ $input['email'] }}</p>
                <input type="hidden" name="email" value="{{ $input['email'] }}">
            </div>
        </div>

        <!-- 4. 電話番号 -->
        <div class="form-group confirm-group">
            <label>電話番号</label>
            <div class="form-field-wrapper">
                <!-- ContactController@confirm で結合された 'tel' フィールドを使用 -->
                <p class="confirm-value">{{ $input['tel'] }}</p>
                <!-- DB保存用に結合したtelをhiddenで送信 -->
                <input type="hidden" name="tel" value="{{ $input['tel'] }}">
            </div>
        </div>

        <!-- 5. 住所 -->
        <div class="form-group confirm-group">
            <label>住所</label>
            <div class="form-field-wrapper">
                <p class="confirm-value">{{ $input['address'] }}</p>
                <input type="hidden" name="address" value="{{ $input['address'] }}">
            </div>
        </div>

        <!-- 6. 建物名 -->
        <div class="form-group confirm-group">
            <label>建物名</label>
            <div class="form-field-wrapper">
                <p class="confirm-value">{{ $input['building'] ?? 'なし' }}</p>
                <input type="hidden" name="building" value="{{ $input['building'] ?? '' }}">
            </div>
        </div>

        <!-- 7. お問い合わせの種類 -->
        <div class="form-group confirm-group">
            <label>お問い合わせの種類</label>
            <div class="form-field-wrapper">
                <p class="confirm-value">{{ $input['category_content'] }}</p>
                <input type="hidden" name="category_id" value="{{ $input['category_id'] }}">
            </div>
        </div>

        <!-- 8. お問い合わせ内容 -->
        <div class="form-group confirm-group">
            <label>お問い合わせ内容</label>
            <div class="form-field-wrapper">
                <p class="confirm-value detail-value">{{ $input['detail'] }}</p>
                <input type="hidden" name="detail" value="{{ $input['detail'] }}">
            </div>
        </div>

        <!-- ボタンアクション -->
        <div class="form-actions confirm-actions">
            <!-- 送信ボタン (DB保存 -> /completeへリダイレクト) -->
            <button type="submit" class="confirm-button">送信</button>
            
            <!-- 修正ボタン (入力画面へ戻る) -->
            <!-- name="back" を追加し、これをトリガーとしてPOSTで/confirmに戻ることでold()を有効にする -->
            <button type="submit" name="back" value="true" class="back-button">修正</button>
        </div>
    </form>
@endsection
