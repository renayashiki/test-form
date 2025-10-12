{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="ja">
@include('layouts.partials.head')

<body>
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
</body>
</html>
