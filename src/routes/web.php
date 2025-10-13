<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

/*
|
| 入力ページ: /
| 確認ページ: /confirm
| サンクスページ: /thanks
| 管理画面: /admin
| ユーザ登録ページ: /register（Fortify）
| ログインページ: /login（Fortify）
|
*/

// ======== TOP → お問い合わせフォーム入力ページ ========
Route::get('/', [ContactController::class, 'index'])->name('contact.index');

// ======== お問い合わせ確認ページ ========
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// ======== サンクスページ ========
Route::post('/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

// ======== Fortify系ルートは自動生成される想定 ========
// Auth::routes(); は Fortify使用時は不要

// ======== /admin → /admin/contacts にリダイレクト ========
Route::get('/admin', function () {
    return redirect()->route('admin.index');
})->middleware('auth');

// ======== 管理画面 ========
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/contacts', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/contacts/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/contacts/export', [AdminController::class, 'export'])->name('admin.export');
});
