<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Fortifyが認証(login/register/logout)ルートを自動登録するため、Auth::routes()は使用しません。
*/

// 1. お問い合わせフォーム関連のルート（一般ユーザー向け）
// ----------------------------------------------------

// お問い合わせ入力画面 (GET /)
Route::get('/', [ContactController::class, 'index'])->name('contact.index');

// 確認画面へPOST (POST /confirm)
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm'); // 👈 これが必要です

// 修正ボタンを押して入力画面へ戻る処理
Route::post('/confirm', [ContactController::class, 'back'])->name('contact.back');

// DBへ保存し完了画面へリダイレクト (POST /thanks)
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');

// 完了画面表示 (GET /thanks)
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');


// 2. 管理画面関連のルート（認証ユーザー向け）
// ----------------------------------------------------

Route::middleware('auth')->prefix('admin')->group(function () {
    // ログイン後のTOP (Fortifyリダイレクト先)
    Route::get('/contacts', [AdminController::class, 'index'])->name('admin.index');

    // CSVエクスポート
    Route::get('/contacts/export', [AdminController::class, 'export'])->name('admin.export');

    // 詳細表示
    Route::get('/contacts/{contact}', [AdminController::class, 'show'])->name('admin.show');

    // 削除
    Route::delete('/contacts/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');
});
