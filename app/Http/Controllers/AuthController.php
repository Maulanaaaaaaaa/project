<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('tampilan.login');
    }


    // -------------------------
    //       GOOGLE LOGIN
    // -------------------------

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    private function downloadGoogleAvatar(string $url, string $googleId): ?string
    {
        try {
            // Ambil file dari URL Google
            $response = Http::get($url);

            if (!$response->successful()) {
                return null;
            }

            // Nama file unik
            $filename = "avatars/google/{$googleId}_" . time() . ".jpg";

            // Simpan ke storage/app/public/avatars/google/
            Storage::disk('public')->put($filename, $response->body());

            // Return path untuk database
            return "storage/" . $filename;
        } catch (\Exception $e) {
            return null;
        }
    }


    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login Google dibatalkan.');
        }

        $avatarUrl = $googleUser->getAvatar();

        $user = User::where('email', $googleUser->getEmail())->first();

        $oldAvatar = $user->avatar_local_path ?? null;

        $localAvatar = $this->downloadGoogleAvatar($avatarUrl, $googleUser->getId());

        if ($oldAvatar && Storage::disk('public')->exists(str_replace('storage/', '', $oldAvatar))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $oldAvatar));
        }

        if ($user) {
            $user->update([
                'google_id' => $googleUser->getId(),
                'google_avatar' => $avatarUrl,
                'avatar_local_path' => $localAvatar,
                'last_login_provider' => 'google',
            ]);
        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'google_avatar' => $avatarUrl,
                'avatar_local_path' => $localAvatar,
                'password' => bcrypt(Str::random(32)),
                'last_login_provider' => 'google',
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }



    // -------------------------
    //       GITHUB LOGIN
    // -------------------------

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login GitHub dibatalkan.');
        }

        $avatar = $githubUser->getAvatar();

        $user = User::where('email', $githubUser->getEmail())->first();

        if ($user) {
            $user->update([
                'github_id' => $githubUser->getId(),
                'github_avatar' => $avatar,
                'last_login_provider' => 'github',
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'github_id' => $githubUser->getId(),
                'github_avatar' => $avatar,
                'password' => bcrypt(Str::random(32)),
                'last_login_provider' => 'github',
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }


    // -------------------------
    //      FACEBOOK LOGIN
    // -------------------------

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            // Ambil user Facebook
            $fbUser = Socialite::driver('facebook')
                ->stateless()
                ->scopes(['email', 'public_profile'])
                ->user();
        } catch (\Exception $e) {
            // User menekan CANCEL atau terjadi error OAuth
            return redirect('/login')->with('error', 'Login Facebook dibatalkan.');
        }

        // Ambil avatar besar
        $avatar = $fbUser->avatar_original ?? $fbUser->getAvatar();

        // Email fallback jika tidak ada email dari Facebook
        $email = $fbUser->getEmail() ?? "fb_{$fbUser->getId()}@facebook.local";

        // Cari user lama
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'facebook_id' => $fbUser->getId(),
                'facebook_avatar' => $avatar,
                'last_login_provider' => 'facebook',
            ]);
        } else {
            $user = User::create([
                'name' => $fbUser->getName(),
                'email' => $email,
                'facebook_id' => $fbUser->getId(),
                'facebook_avatar' => $avatar,
                'google_id' => null,
                'google_avatar' => null,
                'github_id' => null,
                'github_avatar' => null,
                'password' => bcrypt(Str::random(32)),
                'last_login_provider' => 'facebook',
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }


    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
