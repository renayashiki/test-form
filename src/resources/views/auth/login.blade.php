{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Login | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('header_button')
    <a href="{{ route('register') }}" class="header-link">register</a>
@endsection

@section('content')
<div class="auth-container">
    <h2 class="auth-title">Login</h2>
    <div class="auth-card">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email')<div class="error-message">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input type="password" name="password">
                @error('password')<div class="error-message">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn-submit">ログイン</button>
        </form>
    </div>
</div>
@endsection
