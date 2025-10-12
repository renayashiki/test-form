@extends('layouts.app')

@section('title', 'お問い合わせ')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}">
@endsection

@section('content')
<div class="contact-page">

    {{-- タイトル部分 --}}
    <div class="page-header">
        <h1 class="brand-title">FashionablyLate</h1>
        <hr class="divider">
        <h2 class="contact-heading">Contact</h2>
    </div>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>※ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- フォーム --}}
    <form action="{{ route('contact.confirm') }}" method="POST" class="contact-form">
        @csrf

        {{-- お名前 --}}
        <div class="form-group">
            <label for="name">お名前<span class="required">※</span></label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                value="{{ old('name') }}" 
                placeholder="例）山田 太郎"
                class="form-input">
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label for="email">メールアドレス<span class="required">※</span></label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email') }}" 
                placeholder="例）example@fashionablylate.jp"
                class="form-input">
        </div>

        {{-- 性別 --}}
        <div class="form-group">
            <label>性別<span class="required">※</span></label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="男性" {{ old('gender') == '男性' ? 'checked' : '' }}> 男性</label>
                <label><input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性</label>
                <label><input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}> その他</label>
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <label for="address">住所<span class="required">※</span></label>
            <input 
                type="text" 
                name="address" 
                id="address" 
                value="{{ old('address') }}" 
                placeholder="例）東京都港区北青山3-6-7"
                class="form-input">
        </div>

        {{-- 建物名 --}}
        <div class="form-group">
            <label for="building">建物名</label>
            <input 
                type="text" 
                name="building" 
                id="building" 
                value="{{ old('building') }}" 
                placeholder="例）青山ビル201"
                class="form-input">
        </div>

        {{-- 電話番号 --}}
        <div class="form-group">
            <label for="tel1">電話番号<span class="required">※</span></label>
            <div class="tel-inputs">
                <input type="text" name="tel1" id="tel1" value="{{ old('tel1') }}" maxlength="4" placeholder="090" class="form-input tel">
                <span class="tel-separator">-</span>
                <input type="text" name="tel2" id="tel2" value="{{ old('tel2') }}" maxlength="4" placeholder="1234" class="form-input tel">
                <span class="tel-separator">-</span>
                <input type="text" name="tel3" id="tel3" value="{{ old('tel3') }}" maxlength="4" placeholder="5678" class="form-input tel">
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form-group">
            <label for="category">お問い合わせの種類<span class="required">※</span></label>
            <div class="select-wrapper">
                <select name="category" id="category" class="form-select">
                    <option value="">選択してください</option>
                    <option value="商品のご質問" {{ old('category') == '商品のご質問' ? 'selected' : '' }}>商品のご質問</option>
                    <option value="返品・交換" {{ old('category') == '返品・交換' ? 'selected' : '' }}>返品・交換</option>
                    <option value="その他" {{ old('category') == 'その他' ? 'selected' : '' }}>その他</option>
                </select>
                <span class="select-arrow">▼</span>
            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form-group">
            <label for="content">お問い合わせ内容<span class="required">※</span></label>
            <textarea 
                name="content" 
                id="content" 
                rows="5"
                placeholder="お問い合わせ内容を入力してください"
                class="form-textarea">{{ old('content') }}</textarea>
        </div>

        {{-- ボタン --}}
        <div class="form-actions">
            <button type="submit" class="confirm-button">確認画面へ</button>
        </div>
    </form>
</div>
@endsection
