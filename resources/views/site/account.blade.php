<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
<header class="d-f f-d_c">
    <div class="header-top d-f s-b a-i_c">
        <div class="block-social d-f">
            <a href="#"><img src="{{ asset('img/vk.png') }}" alt="vk" class="icon-social"></a>
            <a href="#"><img src="{{ asset('img/instagram.png') }}" alt="instagram" class="icon-social"></a>
            <a href="#"><img src="{{ asset('img/telegram.png') }}" alt="telegram" class="icon-social"></a>
        </div>
        <p>tebe_chego@inbox.ru</p>
        <a href="{{ route('main') }}">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo">
        </a>
        <p>+7 952 884-26-95</p>

        @if(Auth::check())
            <div class="user-dropdown">
                <div class="profile-avatar">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}" alt="avatar" class="user-avatar-large">
                </div>
                <div class="user-menu">
                    <a href="{{ route('account') }}">Личный кабинет</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Выйти</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('auth') }}">
                <button class="u-bold auth-btn">Войти</button>
            </a>
        @endif
    </div>

    <div class="header-bottom d-f j-c_c">
        <a href="{{ route('portfolio') }}">Портфолио</a>
        <a href="{{ route('services') }}">Услуги</a>
        <a href="{{ route('catalog') }}">Каталог</a>
        <a href="{{ route('reviews') }}">Отзывы</a>
        <a href="#">Контакты</a>
    </div>
</header>

<section class="account">
    <h2>Личный кабинет</h2>

    {{-- Профиль --}}
    <div class="account-block">
        <h3>Профиль</h3>
        <div class="profile-info">
            <div class="profile-avatar">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}" alt="avatar" class="user-avatar-large">
            </div>
            <p><strong> Имя:</strong> {{ Auth::user()->name }}</p>
            <p><strong> Email:</strong> {{ Auth::user()->email }}</p>
            <a href="{{ route('account.profile') }}"><button>Редактировать профиль</button></a>
        </div>
    </div>

    {{-- Свадебные проекты / корзина --}}
    <div class="account-block">
        <h3>Мои свадебные проекты</h3>
        @if(isset($userProjects) && count($userProjects) > 0)
            <ul class="projects-list">
                @foreach($userProjects as $project)
                    <li>
                        <strong>{{ $project->title }}</strong> — {{ $project->status }}
                        <a href="{{ route('project.show', $project->id) }}"><button>Открыть</button></a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>У вас пока нет свадебных проектов.</p>
            <a href="{{ route('catalog') }}"><button>Добавить проект</button></a>
        @endif
    </div>

    {{-- Избранные фото --}}
    <div class="account-block">
        <h3>Избранные фото</h3>
        @if(isset($favoritePhotos) && count($favoritePhotos) > 0)
            <div class="favorite-photos d-f f-w">
                @foreach($favoritePhotos as $photo)
                    <div class="photo-card">
                        <img src="{{ asset('storage/' . $photo->path) }}" alt="photo">
                        <p>{{ $photo->title }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p>Вы ещё не добавили избранные фото.</p>
        @endif
    </div>

    {{-- Настройки --}}
    <div class="account-block">
        <h3>Настройки</h3>
        <p>Управляйте уведомлениями и персональными данными.</p>
        <a href="{{ route('account.settings') }}"><button>Изменить настройки</button></a>
    </div>
</section>

<footer>
    <div class="footer-top container d-f s-b a-i_c">
        <a href="{{ route('main') }}">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="logo">
        </a>
        <div class="footer-links d-f">
            <a href="{{ route('portfolio') }}">Портфолио</a>
            <a href="{{ route('services') }}">Услуги</a>
            <a href="{{ route('catalog') }}">Каталог</a>
            <a href="{{ route('reviews') }}">Отзывы</a>
            <a href="#">Контакты</a>
        </div>
        <button class="u-bold">Связаться</button>
    </div>
</footer>
</body>
</html>
