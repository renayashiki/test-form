<?php

namespace App\Providers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ===============================
        // 🔹 ログイン試行制限（Too Many Requests対策）
        // ===============================
        RateLimiter::for('login', function (Request $request) {
            // 開発中は制限なし（本番では perMinute(10) などに戻す）
            return Limit::perMinute(10)->by($request->ip());
        });

        // Fortifyがルートを無視しないように設定
        if (method_exists(Fortify::class, 'ignoreRoutes')) {
            Fortify::ignoreRoutes(false);
        }

        // ユーザー登録アクション
        Fortify::createUsersUsing(CreateNewUser::class);

        // ===============================
        // 🔹 ログイン認証＋日本語バリデーション
        // ===============================
        Fortify::authenticateUsing(function (Request $request) {
            $validator = Validator::make(
                $request->only('email', 'password'),
                [
                    'email' => ['required', 'email'],
                    'password' => ['required', 'string'],
                ],
                [
                    'email.required' => 'メールアドレスを入力してください。',
                    'email.email' => 'メールアドレスはメール形式で入力してください。',
                    'password.required' => 'パスワードを入力してください。',
                ]
            );

            if ($validator->fails()) {
                throw new \Illuminate\Validation\ValidationException($validator);
            }

            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        // ===============================
        // 🔹 使用するBladeビュー指定
        // ===============================
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::registerView(fn() => view('auth.register'));
    }
}
