@extends('layouts.app')

@section('title', '確認画面 | FashionablyLate')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<style>
    body {
        background-color: #fff !important;
    }
</style>
@endsection

@section('content')
<div class="contact-page">
    <h1 class="page-title">Confirm</h1>

    {{-- 安全のため $inputs が存在しない場合に備える --}}
    @php
        $inputs = $inputs ?? [];
        $category_name = $category_name ?? '';
        // 電話番号：コントローラで結合済みならそれを使う。なければ個別要素を結合してみる
        $tel = $inputs['tel'] ?? (
            (($inputs['tel1'] ?? '') !== '' ? $inputs['tel1'] : '') .
            ((($inputs['tel2'] ?? '') !== '') ? '-' . $inputs['tel2'] : '') .
            ((($inputs['tel3'] ?? '') !== '') ? '-' . $inputs['tel3'] : '')
        );
    @endphp

    <div class="confirm-box">
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>{{ ($inputs['last_name'] ?? '') }} {{ ($inputs['first_name'] ?? '') }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @php $g = $inputs['gender'] ?? null; @endphp
                    @if($g == 1) 男性
                    @elseif($g == 2) 女性
                    @elseif($g == 3) その他
                    @else 不明
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $inputs['email'] ?? '' }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $tel }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $inputs['address'] ?? '' }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $inputs['building'] ?? 'なし' }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $category_name }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{!! nl2br(e($inputs['detail'] ?? '')) !!}</td>
            </tr>
        </table>

        <div class="confirm-actions">
            {{-- 送信（DB保存）: ContactController@store はセッションからデータを読む実装なので hidden は不要 --}}
            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <button type="submit" class="btn-submit">送信</button>
            </form>

            {{-- 修正（入力画面へ戻す）: back はセッションの contact_data を old() に流す実装です --}}
            <form method="POST" action="{{ route('contact.back') }}">
                @csrf
                <button type="submit" class="btn-back">修正</button>
            </form>
        </div>
    </div>
</div>
@endsection
