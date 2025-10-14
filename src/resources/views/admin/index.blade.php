<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate Admin System</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}"> 
</head>
<body>
    <header class="admin-top-header">
        <div class="admin-header-content">
            <h1 class="admin-header-logo">FashionablyLate</h1>
            <nav>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="admin-logout-btn">logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="admin-main-content">
        <div class="admin-content-wrapper">

            <h1 class="admin-page-title">Admin</h1>

            <div class="search-area">
                <form action="{{ route('admin.index') }}" method="GET" class="search-form">
                    
                    <div class="search-form-inline">
                        
                        <div class="search-item name-item">
                            <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}" class="search-input" placeholder="お名前やメールアドレスを入力してください">
                        </div>
                        
                        <div class="search-item gender-item">
                            <select name="gender" id="gender" class="search-select custom-select-arrow">
                                @php
                                    $selected_gender = request('gender');
                                @endphp
                                <option value="" @if(is_null($selected_gender) || $selected_gender === '') selected @endif>性別</option>
                                <option value="1" @if($selected_gender === '1') selected @endif>男性</option>
                                <option value="2" @if($selected_gender === '2') selected @endif>女性</option>
                                <option value="3" @if($selected_gender === '3') selected @endif>その他</option>
                            </select>
                        </div>
                        
                        <div class="search-item category-item">
                            <select name="category_id" id="category_id" class="search-select custom-select-arrow">
                                <option value="">お問い合わせの種類</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                                        {{ $category->content }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="search-item date-item">
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="search-input date-input-field" placeholder="年 / 月 / 日">
                            <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        </div>
                        
                        <div class="search-item search-btn-item">
                            <button type="submit" class="search-submit-btn">検索</button>
                        </div>

                        <div class="search-item reset-btn-item">
                            <a href="{{ route('admin.index') }}" class="search-reset-btn reset-link">リセット</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-utility">
                <div class="export-area">
                    <a href="{{ route('admin.export', request()->query()) }}" class="export-btn">エクスポート</a>
                </div>
                @if ($contacts->hasPages())
                    <div class="pagination-area-top">
                        {{ $contacts->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>

            <div class="contact-list-table-wrapper">
                <table class="contact-list-table">
                    <thead>
                        <tr>
                            <th class="table-header-name">お名前</th>
                            <th class="table-header-gender">性別</th>
                            <th class="table-header-email">メールアドレス</th>
                            <th class="table-header-category">お問い合わせ種類</th>
                            <th class="table-header-detail"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                            <td>
                                @if($contact->gender == 1) 男性
                                @elseif($contact->gender == 2) 女性
                                @else その他
                                @endif
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category->content }}</td>
                            <td class="detail-cell">
                                {{-- JSを使用しないCSSターゲットによるモーダル表示 --}}
                                <a href="#modal-{{ $contact->id }}" class="detail-btn">詳細</a>
                            </td>
                        </tr>

                        <div id="modal-{{ $contact->id }}" class="modal">
                            <div class="modal-content">
                                {{-- closeボタンは、URLフラグメントをクリアするために # にリンク --}}
                                <a href="#" class="modal-close">&times;</a>
                                <h2 class="modal-title">詳細情報</h2>
                                
                                <form action="/admin/contacts/{{ $contact->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-detail-grid">
                                        
                                        <div class="modal-item">
                                            <div class="modal-label">ID</div>
                                            <div class="modal-value">{{ $contact->id }}</div>
                                        </div>
                                        
                                        <div class="modal-item">
                                            <div class="modal-label">お名前</div>
                                            <div class="modal-value">{{ $contact->last_name }} {{ $contact->first_name }}</div>
                                        </div>

                                        <div class="modal-item">
                                            <div class="modal-label">性別</div>
                                            <div class="modal-value">
                                                @if($contact->gender == 1) 男性
                                                @elseif($contact->gender == 2) 女性
                                                @else その他
                                                @endif
                                            </div>
                                        </div>

                                        <div class="modal-item">
                                            <div class="modal-label">メールアドレス</div>
                                            <div class="modal-value">{{ $contact->email }}</div>
                                        </div>

                                        <div class="modal-item">
                                            <div class="modal-label">電話番号</div>
                                            <div class="modal-value">{{ $contact->tel }}</div>
                                        </div>

                                        <div class="modal-item">
                                            <div class="modal-label">住所</div>
                                            <div class="modal-value">{{ $contact->address }}</div>
                                        </div>

                                        <div class="modal-item">
                                            <div class="modal-label">建物名</div>
                                            <div class="modal-value">{{ $contact->building ?? 'なし' }}</div>
                                        </div>
                                        
                                        <div class="modal-item">
                                            <div class="modal-label">お問い合わせ種類</div>
                                            <div class="modal-value">{{ $contact->category->content }}</div>
                                        </div>

                                        <div class="modal-item modal-item-full">
                                            <div class="modal-label">お問い合わせ内容</div>
                                            <div class="modal-content-box">{{ $contact->detail }}</div>
                                        </div>

                                        <div class="modal-item">
                                            <div class="modal-label">登録日時</div>
                                            <div class="modal-value">{{ $contact->created_at->format('Y-m-d H:i:s') }}</div>
                                        </div>
                                    </div>

                                    <button type="submit" class="modal-delete-btn">削除</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </main>
</body>
</html>