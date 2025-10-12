@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}">
@endsection

@section('content')
<div class="contact-container">
    <div class="contact-header">
        <h1 class="brand-title">FashionablyLate</h1>
        <hr class="header-line">
        <h2 class="contact-title">Contact</h2>
    </div>

    <form action="{{ route('contact.confirm') }}" method="post" class="contact-form">
        @csrf

        {{-- お名前 --}}
        <div class="form-group">
            <label>お名前 <span class="required">※</span></label>
            <div class="name-fields">
                <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label>メールアドレス <span class="required">※</span></label>
            <input type="email" name="email" placeholder="例: example@fashionablylate.jp" value="{{ old('email') }}">
        </div>

        {{-- 性別 --}}
        <div class="form-group">
            <label>性別 <span class="required">※</span></label>
            <div class="gender-options">
                <label><input type="radio" name="gender" value="男性" {{ old('gender')=='男性'?'checked':'' }}> 男性</label>
                <label><input type="radio" name="gender" value="女性" {{ old('gender')=='女性'?'checked':'' }}> 女性</label>
                <label><input type="radio" name="gender" value="その他" {{ old('gender')=='その他'?'checked':'' }}> その他</label>
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <label>住所 <span class="required">※</span></label>
            <input type="text" name="address" placeholder="例: 東京都港区北青山3-6-7" value="{{ old('address') }}">
        </div>

        {{-- 建物名 --}}
        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building" placeholder="例: 青山ビル201" value="{{ old('building') }}">
        </div>

        {{-- 電話番号 --}}
        <div class="form-group">
            <label>電話番号 <span class="required">※</span></label>
            <div class="tel-fields">
                <input type="text" name="tel1" placeholder="090" value="{{ old('tel1') }}">
                <span class="hyphen">-</span>
                <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                <span class="hyphen">-</span>
                <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form-group">
            <label>お問い合わせの種類 <span class="required">※</span></label>
            <div class="select-wrapper">
                <select name="category">
                    <option value="" disabled selected>選択してください</option>
                    <option value="商品について">商品について</option>
                    <option value="返品・交換について">返品・交換について</option>
                    <option value="その他">その他</option>
                </select>
            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form-group">
            <label>お問い合わせ内容 <span class="required">※</span></label>
            <textarea name="detail" placeholder="お問い合わせ内容をご記入ください">{{ old('detail') }}</textarea>
        </div>

        <div class="form-submit">
            <button type="submit">確認画面へ</button>
        </div>
    </form>
</div>
@endsection
