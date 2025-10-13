@extends('layouts.admin')

@section('content')
<div class="admin-wrapper">
    <section class="search-section">
        <form method="GET" action="{{ route('admin.index') }}" class="search-form">
            <div class="search-row">
                <input type="text" name="name" placeholder="名前" value="{{ request('name') }}">
                <input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" @selected(request('gender') == 1)>男性</option>
                    <option value="2" @selected(request('gender') == 2)>女性</option>
                    <option value="3" @selected(request('gender') == 3)>その他</option>
                </select>
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
                <input type="date" name="date" value="{{ request('date') }}">
            </div>

            <div class="search-buttons">
                <button type="submit" class="search-btn">検索</button>
                <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
                <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">エクスポート</a>
            </div>
        </form>
    </section>

    <hr class="divider">

    <section class="table-section">
        <table class="contacts-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>{{ ['','男性','女性','その他'][$contact->gender] }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? '-' }}</td>
                    <td><button class="detail-btn" data-id="{{ $contact->id }}">詳細</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <x-pagination :paginator="$contacts" />
    </section>

    {{-- モーダルウィンドウ --}}
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body"></div>
        </div>
    </div>
</div>
@endsection
