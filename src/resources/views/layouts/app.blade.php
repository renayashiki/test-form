<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FashionablyLate</title>

    <!-- フォント（任意） -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Noto+Sans+JP:wght@400;500&display=swap" rel="stylesheet">

    <!-- 認証用CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
</head>
<body>
    <header class="auth-header">
        <div class="auth-header-inner">
            <h1 class="auth-logo">FashionablyLate</h1>

            <nav class="auth-nav">
                @if (Request::is('login'))
                    <a href="{{ route('register') }}" class="auth-nav-btn">register</a>
                @elseif (Request::is('register'))
                    <a href="{{ route('login') }}" class="auth-nav-btn">login</a>
                @else
                    <!-- 他ページでは表示させない or 必要に応じて追加 -->
                @endif
            </nav>
        </div>
    </header>

    <main class="auth-main">
        @yield('content')
    </main>
</body>
</html>
