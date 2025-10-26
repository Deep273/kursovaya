<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Регистрация</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet"/>
</head>
<body>
<div class="center-wrapper">
    <section class="auth">
        <div class="close-button d-f">
            <a href="{{ route('main') }}"><img src="img/close-page-auth.png" alt="close-page-auth"/></a>
        </div>

        <div class="auth-block">
            <p>Регистрация</p>

            <form action="{{ route('register.submit') }}" method="post" class="d-f f-d_c">
                @csrf
                <input type="text" name="name" placeholder="Введите имя" required />
                <input type="email" name="email" placeholder="Введите электронную почту" required />
                <input type="text" name="number_phone" placeholder="Введите номер телефона" required />
                <input type="password" name="password" placeholder="Пароль" required />
                <input type="password" name="password_confirmation" placeholder="Подтвердите пароль" required />
                <button type="submit">Зарегистрироваться</button>
            </form>

            <div class="remember-and-forgot d-f s-b a-i_c">
                <div class="remember d-f a-i_c">
                    <input type="checkbox" name="remember" id="remember" />
                    <p>Запомнить меня</p>
                </div>
            </div>
        </div>

        <div class="down-button d-f j-c_c">
            <p>Уже есть аккаунт?</p>
            <a href="{{ route('auth') }}">Войти</a>
        </div>
    </section>
</div>
</body>
</html>
