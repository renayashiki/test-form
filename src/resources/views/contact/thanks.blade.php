@extends('layouts.app')

@section('title', 'お問い合わせ完了')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-container">
    <div class="thanks-message">
        <p>お問い合わせありがとうございました</p>
    </div>

    <div class="thanks-button">
        <a href="{{ url('/') }}">HOME</a>
    </div>
</div>
@endsection
