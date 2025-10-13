@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h2 class="auth-title">Login</h2>

    <div class="auth-card square">
        <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
            @csrf

            <div class="form-row">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com" required autofocus>
                @error('email') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password" placeholder="例：coachtech06" required>
                @error('password') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="auth-btn">ログイン</button>
        </form>
    </div>
</div>
@endsection
