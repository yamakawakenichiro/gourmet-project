<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    public function getGoogleAuth()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::firstOrCreate([
            'email' => $googleUser->email
        ], [
            'name' => $googleUser->name, // Googleから取得した名前
            'email_verified_at' => now(), // 現在の時刻でEmailを確認済みに
            'google_id' => $googleUser->id, // Googleから取得したID
            'password' => bcrypt(Str::random(16)), // ダミーパスワード
            // 'remember_token'は自動で処理される
        ]);
        Auth::login($user, true);
        return redirect()->route('index')->with('message', 'ログインしました');
    }
}
