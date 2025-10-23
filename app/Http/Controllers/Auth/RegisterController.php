<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    // Форма регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Обработка регистрации
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'number_phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // После успешной регистрации — переход на страницу входа
        return redirect()->route('auth')->with('success', 'Вы успешно зарегистрировались! Теперь войдите в систему.');
    }
}
