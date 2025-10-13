<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理画面</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Noto Sans JP', sans-serif;
      background-color: #f5f5f5;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col">
  <header class="bg-gray-800 text-white py-4">
    <div class="container mx-auto px-6 flex justify-between items-center">
      <h1 class="text-xl font-semibold">管理システム</h1>
      <nav>
        <a href="{{ route('admin.index') }}" class="text-sm hover:underline">一覧</a>
        <a href="{{ route('logout') }}" class="ml-4 text-sm hover:underline">ログアウト</a>
      </nav>
    </div>
  </header>

  <main class="flex-grow container mx-auto px-6 py-8">
    @yield('content')
  </main>

  <footer class="bg-gray-100 py-3 text-center text-sm text-gray-500">
    &copy; 2025 Coachtech Admin System
  </footer>
</body>
</html>
