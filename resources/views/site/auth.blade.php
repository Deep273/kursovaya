<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="center-wrapper">
    <section class="auth">
        <div class="close-button d-f">
            <a href="{{ route('main') }}">
                <img src="img/close-page-auth.png" alt="close-page-auth">
            </a>
        </div>

        <div class="auth-block">
            <p>Вход</p>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('auth.login') }}" method="post" class="d-f f-d_c">
                @csrf
                <input type="text" name="contact" placeholder="Введите электронную почту или номер телефона" value="{{ old('contact') }}" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Войти</button>
                @error('contact')
                <div class="error">{{ $message }}</div>
                @enderror
            </form>

            <div class="remember-and-forgot d-f s-b a-i_c">
                <div class="remember d-f a-i_c">
                    <label>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Запомнить меня
                    </label>
                </div>
            </div>

            <div class="down-button d-f j-c_c">
                <p>Нет аккаунта?</p>
                <a href="{{ route('register') }}">Зарегистрироваться</a>
            </div>
        </div>
    </section>
</div>
</body>
</html>
