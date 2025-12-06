<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                <div class="nav-avatar">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}"
                         alt="avatar" class="user-avatar-large">
                </div>
                <div class="user-menu">
                    <a href="{{ route('account') }}">Личный кабинет</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Выйти</button>
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

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <div class="account-block">
        <h3>Профиль</h3>
        <div class="profile-info">
            @if(session('success'))
                <div class="alert-success">{{ session('account_success') }}</div>
            @endif

            <div class="profile-avatar">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}" alt="avatar" class="user-avatar-large">
            </div>
            <p><strong> Имя:</strong> {{ Auth::user()->name }}</p>
            <p><strong> Email:</strong> {{ Auth::user()->email }}</p>
            <a href="{{ route('account.profile') }}"><button>Редактировать профиль</button></a>
        </div>
    </div>

    <div class="account-block">
        <h3>Мой свадебный проект</h3>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if($userProject)
            <p><strong>Дата свадьбы:</strong> {{ \Carbon\Carbon::parse($userProject->date)->format('d.m.Y H:i') }}</p>
            <p><strong>Стоимость:</strong> {{ $userProject->price }} ₽</p>
            <a href="{{ route('project.show', $userProject->wedding_project_id) }}">
                <button id="myProjectBtn">Мой проект</button>
            </a>
        @else
            <p>У вас пока нет свадебного проекта.</p>
            <button id="createProjectBtn" type="button">Создать проект</button>
        @endif
    </div>

    <div id="createProjectModal" class="modal @if($errors->project->any()) open @endif">
    <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Создать свадебный проект</h3>
            <form action="{{ route('project.store') }}" method="POST">
                @csrf

                <label for="date">Дата свадьбы:</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" required>
                @error('date')
                <p class="error">{{ $message }}</p>
                @enderror

                <label for="time">Время свадьбы:</label>
                <input type="time" id="time" name="time" value="{{ old('time') }}">

                <button type="submit" class="submit-btn">Создать</button>
            </form>
        </div>
    </div>




    <div class="account-block">
        <h3>Избранные фото</h3>

        {{-- Сообщения --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        {{-- Форма отправки заявки --}}
        <div class="favorite-add-form">
            <h4>Добавить новое избранное фото</h4>
            <form action="{{ route('favorite.add') }}" method="POST" class="fav-form" enctype="multipart/form-data">
                @csrf
                <div class="custom-file-input-wrapper">
                    <input type="file" name="photo" id="photoInput" accept="image/*">
                    <label for="photoInput" class="custom-file-label">Выберите файл</label>
                </div>

                {{-- Ошибка --}}
                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Сообщение об успехе --}}
                @if(session('favorite_success'))
                    <div class="alert alert-success">{{ session('favorite_success') }}</div>
                @endif

                <button type="submit">Отправить заявку</button>
            </form>
        </div>




        {{-- Одобренные фото --}}
        <h4 class="fav-title">Одобренные фото</h4>

        @if($favoriteApproved->count() > 0)
            <div class="favorite-photos d-f f-w">
                @foreach($favoriteApproved as $photo)
                    <div class="photo-card">
                        <img src="{{ asset('storage/' . $photo->link) }}" alt="photo">
                        <p>Одобрено</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="fav-empty">Пока нет одобренных фото.</p>
        @endif


        {{-- Ожидающие одобрения --}}
        <h4 class="fav-title">Заявки в обработке</h4>

        @if($favoritePending->count() > 0)
            <div class="favorite-photos d-f f-w">
                @foreach($favoritePending as $photo)
                    <div class="photo-card pending">
                        <img src="{{ asset('storage/' . $photo->link) }}" alt="photo">
                        <p>Ожидает подтверждения администратора</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="fav-empty">Нет заявок в ожидании.</p>
        @endif

    </div>


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
        <p class="footer-hiden">
            Наш свадебный портал призван серьезно облегчить жизнь будущим молодоженам, подарив им
            незабываемые впечатления.
        </p>
        <button class="u-bold">Связаться</button>
    </div>
    <p class="container">
        Наш свадебный портал призван серьезно
        облегчить жизнь будущим молодоженам,
        подарив им незабываемые впечатления.
    </p>
    <div class="footer-bottom container u-bold d-f s-b a-i_c">
        <p class="u-bold">&copy;2024 Все права защищены</p>
        <p class="u-bold">+7 952 884-26-95</p>
        <p class="u-bold">tebe_chego@inbox.ru</p>
    </div>
</footer>

    <script src="{{ asset('js/account.js') }}"></script>
</body>
</html>

