@extends('layouts.admin')

@section('body_class', 'white-page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="admin-dashboard-container">
    <h2>Admin</h2>
    
    <div class="search-area">
        <form action="{{ route('admin.index') }}" method="GET" class="search-form">
            <input type="text" name="name" placeholder="名前またはメールアドレスを入力してください" value="{{ request('name') }}">
            
            <select name="gender">
                <option value="">性別</option>
                <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
                <option value="女性" {{ request('女性') == '女性' ? 'selected' : '' }}>女性</option>
                <option value="その他" {{ request('その他') == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
            
            <select name="category_id">
                <option value="">お問い合わせの種類</option>
                {{-- 💡カテゴリデータをループで表示 --}}
                @isset($categories)
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (int)request('category_id') === $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                @endisset
            </select>
            
            <input type="date" name="date" value="{{ request('date') }}">
            
            <button type="submit" class="search-button">検索</button>
            <a href="{{ route('admin.index') }}" class="reset-button">リセット</a>
        </form>
    </div>

    {{-- ★ ページネーションとエクスポートボタンを横並びにするラッパー ★ --}}
    <div class="list-meta">
        
        <form action="{{ route('admin.export') }}" method="POST">
            @csrf
            {{-- {# 検索条件をhiddenで渡すか、セッションで保持する #} --}}
            <button type="submit" class="export-button">エクスポート</button>
        </form>

        {{-- 💡ページネーションを右寄せで表示します --}}
        <div class="pagination-container">
            {{ $contacts->links() }}
        </div>
    </div>
    
    <div class="contact-list">
        <table>
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- 💡Controllerから渡された $contacts のデータをループで表示 --}}
                @isset($contacts)
                    @foreach ($contacts as $contact)
                        <tr>
                            {{-- 氏名 --}}
                            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                            
                            {{-- 性別 (DB保存形式が数値の場合の変換) --}}
                            <td>
                                @if ($contact->gender == 1)
                                    男性
                                @elseif ($contact->gender == 2)
                                    女性
                                @elseif ($contact->gender == 3)
                                    その他
                                @else
                                    -
                                @endif
                            </td>
                            
                            {{-- メールアドレス --}}
                            <td>{{ $contact->email }}</td>
                            
                            {{-- お問い合わせの種類 (Categoryリレーションを使用) --}}
                            <td>{{ $contact->category->name ?? '不明' }}</td>
                            
                            {{-- 詳細ボタン --}}
                            <td>
                                <a href="{{ route('admin.show', $contact) }}" class="detail-button">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                @endisset

                {{-- データがない場合の表示は省略（空テーブルになる） --}}
            </tbody>
        </table>
    </div>
    
</div>
@endsection