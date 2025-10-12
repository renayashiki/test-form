@extends('layouts.app')

@section('title', '送信完了 | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<style>
    body {
        background-color: #fff !important;
    }
</style>
@endsection

@section('content')
<div class="thanks-page">
    <div class="thanks-box">
        <h1 class="thanks-title">お問い合わせありがとうございました</h1>
        <p class="thanks-message">内容を受け付けました。</p>
        <a href="{{ route('contact.index') }}" class="btn-submit">トップへ戻る</a>
    </div>
</div>
@endsection
