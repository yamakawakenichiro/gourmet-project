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

        // 既に同じメールアドレスで登録されているか確認 (google_idがnullの場合のみ)
        $existingUser = User::where('email', $googleUser->email)
            ->whereNull('google_id')
            ->first();

        if ($existingUser) {
            // メールアドレスが既に登録されている場合
            return redirect()->route('login')->withErrors([
                'email_google' => 'このメールアドレスは既に登録されています。メールアドレスとパスワードを入力してログインしてください。'
            ]);
        }

        $user = User::firstOrCreate([ //指定された条件に一致する最初のレコードを取得します。もしレコードが存在しない場合、新しいレコードを作成します。
            'google_id' => $googleUser->id //意味: Googleから取得したidを基に、ユーザーの存在を確認します。
        ], [ //上が実行されるから、'email_verified_at'に値が入らずnullになる。
            'name' => $googleUser->name, // Googleから取得した名前
            'email' => $googleUser->email,
            'email_verified_at' => now(), // now()現在の時刻でEmailを確認済みに
            'google_id' => $googleUser->id, // Googleから取得したID
            'password' => bcrypt(Str::random(16)), // ダミーパスワード
            // 'remember_token'は自動で処理される
        ]);
        Auth::login($user, true); // ユーザーをログインさせる
        return redirect()->route('index')->with('message', 'ログインしました');
    }
}
