{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Register | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
@endsection

@section('header_button')
    <a href="{{ route('login') }}" class="header-link">login</a>
@endsection

@section('content')
<div class="auth-container">
    <h2 class="auth-title">Register</h2>
    <div class="auth-card">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label>お名前</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name')<div class="error-message">{{ $message }}</div>@enderror
            </div>
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
            <button type="submit" class="btn-submit">登録</button>
        </form>
    </div>
</div>
@endsection
