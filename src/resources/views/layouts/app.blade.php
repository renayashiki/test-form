{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FashionablyLate')</title>

    {{-- リセット --}}
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

    {{-- 共通（ヘッダー・全体の基本） --}}
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    {{-- ページ固有 --}}
    @yield('css')
</head>
<body class="@yield('body_class','')">
    <header class="site-header">
        <div class="header-inner">
            <a href="{{ route('contact.index') }}" class="logo-link">FashionablyLate</a>

            <div class="header-right">
                {{-- header ボタンはページ単位で差し替え（auth だけ表示） --}}
                @hasSection('header_button')
                    @yield('header_button')
                @endif
            </div>
        </div>
    </header>

    <main class="main">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
