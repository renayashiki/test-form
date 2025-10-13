@extends('layouts.admin')

@section('content')
<div class="admin-container">

    <form method="GET" action="{{ route('admin.index') }}" class="search-form">
        <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">
        <select name="gender">
            <option value="">性別</option>
            <option value="男性">男性</option>
            <option value="女性">女性</option>
        </select>
        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
            @endforeach
        </select>
        <input type="date" name="date">
        <button type="submit" class="search-btn">検索</button>
        <a href="{{ route('admin.index') }}" class="reset-link">リセット</a>
        <button type="button" class="export-btn">エクスポート</button>
    </form>

    <table class="contact-table">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th>内容</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->fullname }}</td>
                    <td>{{ $contact->gender }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? '-' }}</td>
                    <td class="text-truncate">{{ Str::limit($contact->detail, 25) }}</td>
                    <td><button class="detail-btn">詳細</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
