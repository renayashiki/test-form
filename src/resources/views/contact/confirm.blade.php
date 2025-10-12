@extends('layouts.app')

@section('title', 'お問い合わせ確認')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact/contact.css') }}">
@endsection

@section('content')
<div class="contact-container">
    <h2 class="contact-title">お問い合わせ確認</h2>

    <form action="{{ route('contact.thanks') }}" method="POST">
        @csrf
        <table class="contact-table">
            <tr>
                <th>お名前</th>
                <td>{{ $inputs['name'] }}
                    <input type="hidden" name="name" value="{{ $inputs['name'] }}">
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $inputs['email'] }}
                    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $inputs['tel1'] }}{{ $inputs['tel2'] }}{{ $inputs['tel3'] }}
                    <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{{ $inputs['body'] }}
                    <input type="hidden" name="body" value="{{ $inputs['body'] }}">
                </td>
            </tr>
        </table>

        <div class="form-button confirm-buttons">
            <button type="submit" name="action" value="submit" class="btn-confirm">送信する</button>
            <button type="submit" name="action" value="back" class="btn-back">修正する</button>
        </div>
    </form>
</div>
@endsection
