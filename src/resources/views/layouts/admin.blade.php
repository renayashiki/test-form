<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate Admin System</title>
    <!-- Admin固有のCSSを読み込み -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}"> 
    <!-- 汎用CSSは、必要に応じてここに含める -->
</head>
<!-- bodyタグのスタイルで、管理者画面全体を強制的に白背景にします -->
<body style="background-color: #FFFFFF;">
    <!-- 管理画面のヘッダー -->
    <header class="admin-header-wrapper">
        <div class="admin-header">
            <h1 class="admin-header-logo">FashionablyLate</h1>
            
        </div>
    </header>

    <main class="admin-main-content">
        @yield('content')
    </main>
</body>
</html>
