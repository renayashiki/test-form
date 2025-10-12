<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FashionablyLate')</title>
    <!-- リセットCSS -->
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <!-- 共通CSS -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- 個別ページCSS -->
    @yield('css')
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a href="/" class="logo-link">FashionablyLate</a>
            <div class="header-right">
                @guest
                    {{-- ユーザーがゲスト（非ログイン）の場合 --}}
                    @if (Request::routeIs('login'))
                        <a href="{{ route('register') }}" class="login-link">register</a>
                    @elseif (Request::routeIs('register'))
                        <a href="{{ route('login') }}" class="login-link">login</a>
                    @endif
                @endguest
            </div>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>
</body>
</html>
