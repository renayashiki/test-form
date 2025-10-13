<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
</head>
<body>
    <header class="admin-header">
        <div class="admin-header-left">
            <h1 class="site-title">FashionablyLate</h1>
            <h2 class="admin-title">Admin</h2>
        </div>
        <div class="admin-header-right">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">logout</button>
            </form>
        </div>
    </header>

    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>
