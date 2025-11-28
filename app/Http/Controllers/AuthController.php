<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * SHOW REGISTER FORM
     */
    public function showRegistrationForm()
    {
        return view('tampilan.register');
    }

    public function showLoginForm()
    {
        return view('tampilan.login');
    }


    /**
     * REGISTER MANUAL
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Simpan user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // TIDAK login otomatis
        return redirect()->route('register')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    /**
     * GOOGLE REDIRECT
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * GOOGLE CALLBACK
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login menggunakan Google.');
        }

        // User berdasarkan google_id
        $user = User::where('google_id', $googleUser->id)->first();

        if (!$user) {
            // User berdasarkan email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Update google_id + avatar
                $user->google_id = $googleUser->id;
                $user->avatar    = $googleUser->avatar ?? $googleUser->getAvatar();
                $user->save();
            } else {
                // Buat user baru
                $user = User::create([
                    'name'      => $googleUser->name,
                    'email'     => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar'    => $googleUser->avatar ?? $googleUser->getAvatar(),
                    'password'  => Hash::make('google_' . uniqid()),
                ]);
            }
        }

        // Login otomatis
        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Berhasil login dengan Google!');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Berhasil login!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
