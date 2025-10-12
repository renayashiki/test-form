@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    <h2 class="auth-title">Login</h2>
    <div class="auth-card">
        <form action="/login" method="post">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" placeholder="例: password123" />
            </div>
            <button type="submit" class="btn-submit">ログイン</button>
        </form>
    </div>
</div>
@endsection