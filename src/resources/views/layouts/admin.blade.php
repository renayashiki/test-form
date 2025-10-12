{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>FashionablyLate - Admin</title>

    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
    {{-- Bootstrap（必要なら） --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    @yield('styles')
</head>
<body class="@yield('body_class','')">
    <header class="admin-header">
        <div class="admin-header__inner">
            <h1 class="admin-header__logo">FashionablyLate</h1>

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
