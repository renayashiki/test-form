<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// ======== お問い合わせ関連 ========

// 入力画面
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

// 確認画面
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// 送信完了画面
Route::post('/contact/thanks', [ContactController::class, 'send'])->name('contact.send');

// 完了画面（GETアクセス防止）
Route::get('/contact/thanks', function () {
    return redirect()->route('contact.index');
});

// ======== 認証系 ========
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::get('/register', fn() => view('auth.register'))->name('register');

// ======== 管理画面 ========
// ※ 認証が完成していない場合は一時的にmiddlewareを外してもOK
Route::prefix('admin')->group(function () {
    Route::get('/contacts', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/contacts/{contact}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/contacts/{contact}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/contacts/export', [AdminController::class, 'export'])->name('admin.export');
});

// ======== トップページ ========
Route::get('/', function () {
    return view('welcome'); // 必要なら 'home' に変更可
})->name('home');

// ======== /admin → /admin/contacts にリダイレクト ========
Route::get('/admin', function () {
    return redirect()->route('admin.index');
});

// ======== /thanks → /contact/thanks に統一 ========
Route::get('/thanks', function () {
    return redirect()->route('contact.index');
});
