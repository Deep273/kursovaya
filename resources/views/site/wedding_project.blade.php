<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой свадебный проект</title>
    <link rel="stylesheet" href="{{ asset('css/wedding_project.css') }}">
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

<section class="cart-style container">
    <h2>Мой свадебный проект</h2>

    <div class="project-info">
        <p><strong>Дата:</strong> {{ $project->date ?? 'Не указана' }}</p>
        <p><strong>Бюджет:</strong> {{ $project->price ? number_format($project->price, 0, ',', ' ') . ' ₽' : 'Не указан' }}</p>
        <p><strong>Статус:</strong> {{ $project->status ?? 'В процессе' }}</p>
    </div>

    <div class="project-items">
        <h3>Выбранные услуги</h3>
        @if(isset($project->services) && $project->services->count() > 0)
            <ul class="cart-list">
                @foreach($project->services as $service)
                    <li class="cart-item d-f s-b a-i_c">
                        <span>{{ $service->name }}</span>
                        <span>{{ $service->category }}</span>
                        <span>{{ number_format($service->price, 0, ',', ' ') }} ₽</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="empty">Пока нет добавленных услуг.</p>
        @endif
    </div>

    <div class="project-items">
        <h3>Выбранные товары</h3>
        @if(isset($project->products) && $project->products->count() > 0)
            <ul class="cart-list">
                @foreach($project->products as $product)
                    <li class="cart-item d-f s-b a-i_c">
                        <span>{{ $product->name }}</span>
                        <span>{{ $product->category }}</span>
                        <span>{{ number_format($product->price, 0, ',', ' ') }} ₽</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="empty">Пока нет добавленных товаров.</p>
        @endif
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
        Наш свадебный портал призван серьезно облегчить жизнь будущим молодоженам, подарив им незабываемые впечатления.
    </p>
    <div class="footer-bottom container u-bold d-f s-b a-i_c">
        <p class="u-bold">&copy;2025 Все права защищены</p>
        <p class="u-bold">+7 952 884-26-95</p>
        <p class="u-bold">tebe_chego@inbox.ru</p>
    </div>
</footer>
</body>
</html>
