<?php

use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Features;

return [
    // ... (中略) ...

    /*
    |--------------------------------------------------------------------------
    | Fortify Features
    |--------------------------------------------------------------------------
    |
    | Some of the Fortify features are optional. You may disable the features
    | you do not need to use, or you may configure other options for them
    | such as the name of the middleware or the route definition.
    |
    */

    'features' => [
        Features::registration(), // 👈 コメントアウトを解除
        // Features::resetPasswords(), // パスワードエラー回避のため、一旦無効のまま
        // Features::emailVerification(),
        Features::updateProfileInformation(), // プロフィール更新も有効化
        Features::updatePasswords(),          // パスワード更新も有効化
        // Features::twoFactorAuthentication([
        //     'confirmPassword' => true,
        // ]),
    ],
];
