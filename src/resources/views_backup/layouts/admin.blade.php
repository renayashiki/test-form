<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>FashionablyLate - Admin</title>

    {{-- 💡 common.css と admin.css を両方読み込む --}}
    <link rel="stylesheet" href="{{ asset('css/common.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    
    @yield('styles')
</head>
<body>
    {{-- ヘッダーは新しいクラス名 (admin-header) で定義 --}}
    <header class="admin-header"> 
        <div class="admin-header__inner">
            <h1 class="admin-header__logo">FashionablyLate</h1>
            
            {{-- ログアウトフォーム --}}
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button">logout</button>
            </form>
        </div>
    </header>

    <main class="admin-main">
        @yield('content')
    </main>
    
    @yield('scripts')
</body>
</html>