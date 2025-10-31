<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Регистрация</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body>
<div class="center-wrapper">
    <section class="auth">
        <div class="close-button d-f">
            <a href="{{ route('main') }}"><img src="{{ asset('img/close-page-auth.png') }}" alt="close-page-auth"/></a>
        </div>

        <div class="auth-block">
            <p>Регистрация</p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="post" class="d-f f-d_c">
                @csrf

                <input type="text" name="name" placeholder="Введите имя" value="{{ old('name') }}" required />
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror

                <input type="email" name="email" placeholder="Введите электронную почту" value="{{ old('email') }}" required />
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror

                <input type="text" name="number_phone" placeholder="Введите номер телефона" value="{{ old('number_phone') }}" required />
                @error('number_phone')
                <span class="error">{{ $message }}</span>
                @enderror

                <input type="password" name="password" placeholder="Пароль" required />
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror

                <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" required />

                <button type="submit">Зарегистрироваться</button>
            </form>

            <div class="down-button d-f j-c_c">
                <p>Уже есть аккаунт?</p>
                <a href="{{ route('auth') }}">Войти</a>
            </div>
        </div>
    </section>
</div>
