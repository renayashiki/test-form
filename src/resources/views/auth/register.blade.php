@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="auth-title">Register</h2>

    <div class="auth-card">
        <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
            @csrf

            <div class="form-row">
                <label for="name">お名前</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="例：山田　太郎" required autofocus>
                @error('name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com" required>
                @error('email') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" placeholder="例：coachtech06" required>
                @error('password') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="auth-btn">登録</button>
        </form>
    </div>
</div>
@endsection
