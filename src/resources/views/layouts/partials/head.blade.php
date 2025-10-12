{{-- 共通 <head> セクション --}}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- 共通CSS --}}
<link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">

{{-- ページ・レイアウトごとの個別CSS --}}
@yield('css')

<title>@yield('title', 'FashionablyLate')</title>
