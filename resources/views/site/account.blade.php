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
            <div class="product-buttons">
                <img src="{{ asset('img/shopping-cart-products.svg') }}" alt="Корзина" class="cart-icon">
            </div>
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
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

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
            <button id="createProjectBtn">Создать проект</button>
        @endif
    </div>

    <div id="createProjectModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Создать свадебный проект</h3>
            <form action="{{ route('project.store') }}" method="POST">
                @csrf

                <label for="date">Дата свадьбы:</label>
                <input type="date" id="date" name="date" required>

                <label for="time">Время свадьбы:</label>
                <input type="time" id="time" name="time">

                <button type="submit" class="submit-btn">Создать</button>
            </form>
        </div>
    </div>



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

<script>
    const modal = document.getElementById("createProjectModal");
    const btn = document.getElementById("createProjectBtn");
    const closeBtn = document.querySelector(".close");

    if (btn) {
        btn.onclick = function() {
            modal.style.display = "flex";
        }
    }

    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>


</body>
</html>
