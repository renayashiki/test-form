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


class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Fortifyがルートを無視しないように設定
        if (method_exists(Fortify::class, 'ignoreRoutes')) {
            Fortify::ignoreRoutes(false);
        }

        // Fortifyのユーザー登録アクションを自前に設定（既に設定済みなら重複しない）
        Fortify::createUsersUsing(CreateNewUser::class);

        // 認証時にフォームバリデーション（日本語メッセージ）を適用
        Fortify::authenticateUsing(function (Request $request) {
            // 明示的にバリデーション（LoginRequest と同等）
            $validator = Validator::make($request->only('email', 'password'), [
                'email' => ['required', 'email'],
                'password' => ['required', 'string'],
            ], [
                'email.required' => 'メールアドレスを入力してください。',
                'email.email' => 'メールアドレスはメール形式で入力してください。',
                'password.required' => 'パスワードを入力してください。',
            ]);

            if ($validator->fails()) {
                // バリデーション失敗時は直ちに例外を投げることで通常のリダイレクト＆エラー表示へ
                throw new \Illuminate\Validation\ValidationException($validator);
            }

            $user = \App\Models\User::where('email', $request->email)->first();

            if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        // Fortifyが使用するビューを指定
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::registerView(fn() => view('auth.register'));
    }
}
