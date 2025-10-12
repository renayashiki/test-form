@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-container">
    {{-- 💡見出しをカードの外に配置 (Loginと同じ) --}}
    <h2 class="auth-title">Register</h2> 
    
    <div class="auth-card">
        <form action="/register" method="post">
            @csrf
            
            {{-- 💡LoginにはないがRegisterに必要な「お名前」フィールド --}}
            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}" />
            </div>

            {{-- メールアドレス (Loginと共通) --}}
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
            </div>
            
            {{-- パスワード (Loginと共通) --}}
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" placeholder="例: password123" />
            </div>
            
            {{-- 💡Loginと同じクラス名を使用し、CSSで右寄せする --}}
            <button type="submit" class="btn-submit">登録</button>
        </form>
    </div>
</div>
@endsection