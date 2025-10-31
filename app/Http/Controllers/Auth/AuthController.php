<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    // Форма входа
    public function showLoginForm()
    {
        return view('site.auth');
    }

    // Обработка входа
    public function login(Request $request)
    {
        $ip = $request->ip();
        $attemptKey = 'login_attempts_' . $ip;
        $timeKey = 'login_blocked_until_' . $ip;

        if (session()->has($timeKey)) {
            $blockedUntil = session($timeKey);
            if (time() < $blockedUntil) {
                $seconds = $blockedUntil - time();
                return back()->withErrors([
                    'throttle' => "Слишком много попыток входа. Пожалуйста, попробуйте через $seconds секунд."
                ])->withInput($request->only('login'));
            } else {
                session()->forget([$attemptKey, $timeKey]);
            }
        }

        $credentials = $request->validate([
            'contact' => 'required|string',
            'password' => 'required|string',
        ]);

        // Определяем, введён email или телефон
        $fieldType = filter_var($request->contact, FILTER_VALIDATE_EMAIL) ? 'email' : 'number_phone';

        if (Auth::attempt([$fieldType => $request->contact, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Проверяем роль и перенаправляем
            if ($user->role === 'admin') {
                return redirect()->route('admin_services');
            }

            // Если обычный пользователь
            return redirect()->route('main');
        }

        return back()->withErrors([
            'contact' => 'Неверные данные для входа.',
        ])->onlyInput('contact');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('main');
    }

}
