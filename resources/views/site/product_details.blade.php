<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Куртка демисезонная</title>
    <link rel="stylesheet" href="{{ asset('css/productdetails.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="d-f f-d_c">
    <div class="header-top d-f s-b a-i_c">
        <div class="block-social d-f">
            <a href="#"><img src="img/vk.png" alt="vk" class="icon-social"></a>
            <a href="#"><img src="img/instagram.png" alt="instagram" class="icon-social"></a>
            <a href="#"><img src="img/telegram.png" alt="telegram" class="icon-social"></a>
        </div>
        <p>tebe_chego@inbox.ru</p>
        <a href="{{ route('main') }}">
            <img src="img/logo.png" alt="logo" class="logo">
        </a>
        <p>+7 952 884-26-95</p>
        @if(Auth::check())
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button class="u-bold" type="submit">Выйти</button>
            </form>
        @else
            <a href="{{ route('auth') }}">
                <button class="u-bold">Войти</button>
            </a>
        @endif
        <!-- Бургер-меню -->
        <input type="checkbox" id="menu-toggle" />
        <label for="menu-toggle" class="burger-menu f-d_c">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </label>
        <!-- Выпадающее меню -->
        <nav class="dropdown-menu">
            <div class="dropdown-links d-f f-d_c">
                <a href="{{ route('portfolio') }}">Портфолио</a>
                <a href="{{ route('services') }}">Услуги</a>
                <a href="{{ route('catalog') }}">Каталог</a>
                <a href="{{ route('reviews') }}">Отзывы</a>
                <a href="#">Контакты</a>
            </div>
            <div class="dropdown-contact d-f f-d_c">
                <p>tebe_chego@inbox.ru</p>
                <p>+7 952 884-26-95</p>
            </div>
        </nav>
    </div>
    <div class="header-bottom d-f j-c_c">
        <a href="{{ route('portfolio') }}">Портфолио</a>
        <a href="{{ route('services') }}">Услуги</a>
        <a href="{{ route('catalog') }}">Каталог</a>
        <a href="{{ route('reviews') }}">Отзывы</a>
        <a href="#">Контакты</a>
    </div>
</header>
<div class="product-detail-container">
    <div class="product-image-block">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image-big">
    </div>
    <div class="product-detail-info">
        <h1 class="product-title">{{ $product->name }}</h1>
        <p class="product-desc">{{ $product->description }}</p>
        <div class="product-price">{{ number_format($product->price, 0, ',', ' ') }} ₽</div>
        <div class="product-buttons">
            <button class="add-cart-btn">Добавить в корзину</button>
            <button class="cart-icon-btn" aria-label="В корзину">
                <img src="{{ asset('img/cart-icon.svg') }}" alt="В корзину">
            </button>
        </div>
    </div>
</div>

<footer>
    <div class="footer-top container d-f s-b a-i_c">
        <a href="{{ route('main') }}">
            <img src="img/logo.png" alt="logo" class="logo">
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
            незабываемыевпечатления.
        </p>
        <button class="u-bold">Связаться</button>
    </div>
    <p class="container">
        Наш свадебный портал призван серьезно облегчить жизнь будущим молодоженам, подарив им
        незабываемыевпечатления.
    </p>
    <div class="footer-bottom container u-bold d-f s-b a-i_c">
        <p class="u-bold">&copy;2024 Все права защищены</p>
        <p class="u-bold">+7 952 884-26-95</p>
        <p class="u-bold">tebe_chego@inbox.ru</p>
    </div>
</footer>
</body>
</html>
