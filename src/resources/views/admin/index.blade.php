@extends('layouts.admin')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-md">
  <h2 class="text-2xl font-bold mb-6 text-gray-700">お問い合わせ一覧</h2>

  {{-- 検索フォーム --}}
  <form action="{{ route('admin.index') }}" method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-5 gap-4">
    <input type="text" name="name" value="{{ request('name') }}" placeholder="お名前" class="border-gray-300 rounded-lg w-full p-2 text-sm">
    <input type="text" name="email" value="{{ request('email') }}" placeholder="メールアドレス" class="border-gray-300 rounded-lg w-full p-2 text-sm">
    <select name="gender" class="border-gray-300 rounded-lg w-full p-2 text-sm">
      <option value="">性別</option>
      <option value="1" @selected(request('gender') == '1')>男性</option>
      <option value="2" @selected(request('gender') == '2')>女性</option>
    </select>
    <select name="category_id" class="border-gray-300 rounded-lg w-full p-2 text-sm">
      <option value="">カテゴリ</option>
      @foreach($categories as $category)
        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
          {{ $category->content }}
        </option>
      @endforeach
    </select>
    <input type="date" name="created_at" value="{{ request('created_at') }}" class="border-gray-300 rounded-lg w-full p-2 text-sm">
    <div class="md:col-span-5 flex justify-end space-x-3">
      <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg text-sm hover:bg-blue-600">検索</button>
      <a href="{{ route('admin.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm hover:bg-gray-400">リセット</a>
    </div>
  </form>

  {{-- テーブル --}}
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm border border-gray-200">
      <thead class="bg-gray-100 text-gray-600">
        <tr>
          <th class="py-3 px-4 text-left border-b">ID</th>
          <th class="py-3 px-4 text-left border-b">お名前</th>
          <th class="py-3 px-4 text-left border-b">メールアドレス</th>
          <th class="py-3 px-4 text-left border-b">性別</th>
          <th class="py-3 px-4 text-left border-b">カテゴリ</th>
          <th class="py-3 px-4 text-left border-b">登録日</th>
          <th class="py-3 px-4 text-center border-b">詳細</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @foreach($contacts as $contact)
        <tr>
          <td class="py-2 px-4">{{ $contact->id }}</td>
          <td class="py-2 px-4">{{ $contact->name }}</td>
          <td class="py-2 px-4">{{ $contact->email }}</td>
          <td class="py-2 px-4">
            {{ $contact->gender === 1 ? '男性' : '女性' }}
          </td>
          <td class="py-2 px-4">{{ $contact->category->content ?? '—' }}</td>
          <td class="py-2 px-4">{{ $contact->created_at->format('Y/m/d') }}</td>
          <td class="py-2 px-4 text-center">
            <a href="{{ route('admin.show', $contact->id) }}" class="text-blue-600 hover:underline">詳細</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-6">
    {{ $contacts->links('pagination::bootstrap-4') }}
  </div>
</div>
@endsection
