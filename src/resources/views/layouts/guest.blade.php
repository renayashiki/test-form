<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'お問い合わせフォーム')</title>
    <link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}">
    @yield('css')
</head>
<body>
    <header class="header-wrapper">
        <div class="contact-container" style="max-width: 800px; padding: 0 20px;">
            <h1 class="header-logo">FashionablyLate</h1>
        </div>
    </header>
    
    <main class="contact-container">
        @yield('content')
    </main>
</body>
</html>
```eof

---

### 2. Bladeファイル (ビュー)

#### A. `resources/views/contact/index.blade.php` (入力画面)

```html:お問い合わせ入力画面:resources/views/contact/index.blade.php
@extends('layouts.guest')

@section('title', 'お問い合わせフォーム')

@section('content')
    <h2 class="contact-title">Contact</h2>
    
    <form action="{{ route('contact.confirm') }}" method="POST" class="contact-form">
        @csrf

        <div class="form-group">
            <label for="last_name">お名前<span class="required-tag">※</span></label>
            <div class="form-field-wrapper">
                <div class="name-inputs">
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
                </div>
                <div class="name-inputs">
                    <p class="name-placeholder">例）山田</p>
                    <p class="name-placeholder">例）太郎</p>
                </div>

                <div class="name-error-message">
                    @error('last_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    @error('first_name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>性別<span class="required-tag">※</span></label>
            <div class="form-field-wrapper">
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                </div>
                @error('gender')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス<span class="required-tag">※</span></label>
            <div class="form-field-wrapper">
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例）test@example.com">
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="tel1">電話番号<span class="required-tag">※</span></label>
            <div class="form-field-wrapper">
                <div class="tel-inputs">
                    <input type="text" name="tel1" id="tel1" value="{{ old('tel1') }}" maxlength="5" placeholder="090">
                    <span class="tel-separator">-</span>
                    <input type="text" name="tel2" id="tel2" value="{{ old('tel2') }}" maxlength="5" placeholder="1234">
                    <span class="tel-separator">-</span>
                    <input type="text" name="tel3" id="tel3" value="{{ old('tel3') }}" maxlength="5" placeholder="5678">
                </div>
                @error('tel1')
                    <p class="error-message validation-error-area">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="address">住所<span class="required-tag">※</span></label>
            <div class="form-field-wrapper">
                <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="例）東京都渋谷区千駄ヶ谷">
                @error('address')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <div class="form-field-wrapper">
                <input type="text" name="building" id="building" value="{{ old('building') }}" placeholder="例）千駄ヶ谷マンション101">
                @error('building')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="category_id">お問い合わせの種類<span class="required-tag">※</span></label>
            <div class="form-field-wrapper">
                <div class="select-wrapper">
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="detail">お問い合わせ内容<span class="required-tag">※</span></label>
            <div class="form-field-wrapper">
                <textarea name="detail" id="detail" class="form-textarea" placeholder="お問い合わせ内容を入力してください">{{ old('detail') }}</textarea>
                @error('detail')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="confirm-button">確認画面</button>
        </div>
    </form>
@endsection