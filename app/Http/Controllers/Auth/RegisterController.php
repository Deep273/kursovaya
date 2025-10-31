<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'required|string|min:2|max:50|unique:users,name',
            'email' => 'required|email|max:50|unique:users,email',
            'number_phone' => [
                'required',
                'string',
                'regex:/^(\+7|8)[0-9]{10}$/',
                'unique:users,number_phone',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'max:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,8}$/',
            ],
        ], [
            'name.required' => 'Введите имя.',
            'name.unique' => 'Такой логин уже зарегистрирован.',
            'email.required' => 'Введите email.',
            'email.unique' => 'Такой email уже зарегистрирован.',
            'number_phone.required' => 'Введите номер телефона.',
            'number_phone.regex' => 'Номер телефона должен начинаться с +7 или 8 и содержать 11 цифр.',
            'number_phone.unique' => 'Такой номер уже зарегистрирован.',
            'password.required' => 'Введите пароль.',
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
            'password.max' => 'Пароль не должен превышать 8 символов.',
            'password.regex' => 'Пароль должен содержать буквы и цифры.',
            'password.confirmed' => 'Пароли не совпадают.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number_phone' => $request->number_phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()
            ->route('auth')
            ->with('success', 'Вы успешно зарегистрировались! Теперь войдите в систему.');
    }
}
