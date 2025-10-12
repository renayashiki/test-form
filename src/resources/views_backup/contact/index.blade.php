@extends('layouts.app')

@section('title', 'お問い合わせ | FashionablyLate')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

{{-- メインコンテンツ --}}
@section('content')
    <div class="contact-page">
        {{-- 修正点1: FashionablyLateとContactのフォント調整に対応 --}}
        <h1 class="page-title">Contact</h1>
        
        <div class="form-box">
            <form action="{{ route('contact.confirm') }}" method="POST">
                @csrf
                
                {{-- 1. お名前 --}}
                <div class="form-group">
                    <div class="form-group-wrap">
                        <label for="last_name">
                            お名前
                            <span class="required-mark">※</span>
                        </label>
                        <div class="form-group-item input-pair">
                            {{-- 姓 --}}
                            <div class="form-group-item">
                                <input type="text" id="last_name" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                            </div>
                            {{-- 名 --}}
                            <div class="form-group-item">
                                <input type="text" id="first_name" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('last_name') || $errors->has('first_name'))
                        <div class="error-message">お名前を入力してください。</div>
                    @endif
                </div>

                {{-- 2. 性別 --}}
                <div class="form-group gender-radio-field">
                    <div class="form-group-wrap">
                        <label>
                            性別
                            <span class="required-mark">※</span>
                        </label>
                        <div class="form-group-item gender-radio-group">
                            {{-- 男性 --}}
                            <label>
                                <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
                                男性
                            </label>
                            {{-- 女性 --}}
                            <label>
                                <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                                女性
                            </label>
                            {{-- その他 --}}
                            <label>
                                <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                                その他
                            </label>
                        </div>
                    </div>
                    @error('gender')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 3. メールアドレス --}}
                <div class="form-group">
                    <div class="form-group-wrap">
                        <label for="email">
                            メールアドレス
                            <span class="required-mark">※</span>
                        </label>
                        <div class="form-group-item">
                            <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                        </div>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 4. 電話番号 --}}
                <div class="form-group">
                    <div class="form-group-wrap">
                        <label for="tel">
                            電話番号
                            <span class="required-mark">※</span>
                        </label>
                        {{-- 修正点4: ハイフン用の<span>を挿入 --}}
                        <div class="form-group-item tel-input-pair">
                             {{-- 最初の3桁 --}}
                            <div class="form-group-item tel-input-field">
                                <input type="tel" id="tel1" name="tel1" placeholder="090" value="{{ old('tel1') }}">
                            </div>
                            <span class="tel-separator">-</span>
                            {{-- 2番目の4桁 --}}
                            <div class="form-group-item tel-input-field">
                                <input type="tel" id="tel2" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                            </div>
                            <span class="tel-separator">-</span>
                            {{-- 最後の4桁 --}}
                            <div class="form-group-item tel-input-field">
                                <input type="tel" id="tel3" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                        <div class="error-message">有効な電話番号をハイフンなしで入力してください。</div>
                    @endif
                </div>

                {{-- 5. 住所 --}}
                <div class="form-group">
                    <div class="form-group-wrap">
                        <label for="address">
                            住所
                            <span class="required-mark">※</span>
                        </label>
                        <div class="form-group-item">
                            <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                        </div>
                    </div>
                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 6. 建物名（任意） --}}
                <div class="form-group">
                    <div class="form-group-wrap">
                        <label for="building">
                            建物名
                        </label>
                        <div class="form-group-item">
                            <input type="text" id="building" name="building" placeholder="例: ファッションビル" value="{{ old('building') }}">
                        </div>
                    </div>
                    @error('building')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- 7. お問い合わせの種類 --}}
                <div class="form-group">
                    <div class="form-group-wrap">
                        <label for="category_id">
                            お問い合わせの種類
                            <span class="required-mark">※</span>
                        </label>
                        <div class="form-group-item">
                            <select id="category_id" name="category_id">
                                {{-- 修正点5: プレースホルダーのテキストを保持 --}}
                                <option value="" disabled selected>選択してください</option> 
                                {{-- ContactController::index() から渡された $categories をループ --}}
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->content }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('category_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 8. お問い合わせ内容 --}}
                <div class="form-group">
                    <div class="form-group-wrap">
                        <label for="detail">
                            お問い合わせ内容
                            <span class="required-mark">※</span>
                        </label>
                        <div class="form-group-item">
                            <textarea id="detail" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                        </div>
                    </div>
                    @error('detail')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn-submit">確認画面</button>
            </form>
        </div>
    </div>
@endsection