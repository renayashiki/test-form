{{-- resources/views/layouts/partials/head.blade.php --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FashionablyLate')</title>

    {{-- 🔹 全ページ共通CSS --}}
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    {{-- 🔹 ページ専用CSS（各ページで上書き可） --}}
    @yield('css')
</head>
