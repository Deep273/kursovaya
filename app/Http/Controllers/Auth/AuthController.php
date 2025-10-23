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
        $credentials = $request->validate([
            'contact' => 'required|string',
            'password' => 'required|string',
        ]);

        // Определяем, введён email или телефон
        $fieldType = filter_var($request->contact, FILTER_VALIDATE_EMAIL) ? 'email' : 'number_phone';

        if (Auth::attempt([$fieldType => $request->contact, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
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
