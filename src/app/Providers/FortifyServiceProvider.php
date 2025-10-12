<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        \Laravel\Fortify\Fortify::ignoreRoutes();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // ユーザー作成処理を定義
        Fortify::createUsersUsing(CreateNewUser::class);

        // プロフィール更新処理
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);

        // パスワード更新処理
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);

        // パスワードリセット処理
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // ログイン画面のビューを指定
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // 新規登録画面のビューを指定
        Fortify::registerView(function () {
            return view('auth.register');
        });
    }


}


