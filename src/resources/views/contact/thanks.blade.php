@extends('layouts.guest')

@section('title', 'お問い合わせ完了')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks-content">
        <div class="thanks-background">Thank you</div>
        
        <div class="thanks-message-wrapper">
            <p class="thanks-message">お問い合わせありがとうございました</p>
            <a href="{{ route('contact.index') }}" class="home-button">HOME</a>
        </div>
    </div>
@endsection