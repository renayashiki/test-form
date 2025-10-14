<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        // ----------------------------------------------------
        // Fortifyのビューバインディングを定義 (Register/Loginエラー対策)
        // ----------------------------------------------------
        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::registerView(function () {
            return view('auth.register');
        });


        // ----------------------------------------------------
        // Fortifyのアクションを定義
        // ----------------------------------------------------
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);

        // 🚨 修正: キャッシュエラーを避けるため、パスワード更新・リセットのバインドを削除します
        // Fortify::updateUserPasswordUsing(UpdateUserPassword::class); // 削除
        // Fortify::resetUserPasswordUsing(ResetUserPassword::class);   // 削除
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by(
                $request->session()->get('login.id') . $request->ip()
            );
        });
    }
}
