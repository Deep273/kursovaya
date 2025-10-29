<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        <div class="user-dropdown">
            <button class="auth-btn">Меню</button>
            <div class="user-menu">
                @if(Auth::check())
                    <a href="{{ route('account') }}">Личный кабинет</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('auth') }}">Войти</a>
                    <a href="{{ route('register') }}">Зарегистрироваться</a>
                @endif
            </div>
        </div>
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
<section class="services">
    <h2>Услуги</h2>
    <div class="services-blocks d-f s-b f-w">
            <div class="services-block">
                <div class="services-block-border">
                    <p>
                        <a href="{{ route('services.catering') }}" class="services-link">Кейтеринг</a>
                    </p>
                </div>
                <div class="services-block-border">
                </div>
            </div>
        <div class="services-block">
            <div class="services-block-border">
                <p>Церемонии</p>
            </div>
            <div class="services-block-border">
            </div>
        </div>
        <div class="services-block">
            <div class="services-block-border">
                <p>Костюмы</p>
            </div>
            <div class="services-block-border">
            </div>
        </div>
        <div class="services-block">
            <div class="services-block-border">
                <p>Организация</p>
            </div>
            <div class="services-block-border">
            </div>
        </div>
        <div class="services-block">
            <div class="services-block-border">
                <p>Фотограф и видеограф. Тематические фотозоны</p>
            </div>
            <div class="services-block-border">
            </div>
        </div>
    </div>
</section>
<section class="expectations d-f">
    <div class="left-block d-f j-c_c">
        <img src="img/light.svg" alt="light" />
    </div>
    <div class="right-block d-f f-d_c j-c_c">
        <h2>Сервис, превосходя ожидания</h2>
        <p>
            Комплименты от шеф-повара перед ужином в ресторане. Автомобиль бизнес-класса по цене комфорта в такси.
            Приятно? О, да! Все это – маленькие детали искреннего сервиса, которые мы реализуем в нашей работе.
        </p>
        <p>
            Организовать свадьбу хорошо – обязанность любого агентства. А предоставить лучшее из возможного
            и сделать с эффектом «вау» – наша любовь.
        </p>
        <button class="u-bold">Узнать подробнее</button>
    </div>
</section>
<section class="care">
    <div class="care-border d-f">
        <img src="img/care.svg" alt="care">
        <div class="care__right-content">
            <h1>Забота о гостях</h1>
            <p>Мы очень любим ваших гостей. Потому что они – часть вас.</p>
            <p>И мы позаботимся о них: поможем с дресс-кодом и подарками, организуем поздравление или сюрприз,
                уточним вкусовые предпочтения, аллергические реакции и не только!</p>
            <p>Интерактивная карта места проведения свадьбы с указанием ключевых локаций (церемония, банкет,
                фотозоны).</p>
            <p>Предложения по развлекательным мероприятиям для гостей до и после свадьбы.</p>
            <button class="u-bold">Узнать подребнее</button>
        </div>
    </div>
    <div class="care__left-hint">
        <p>Свадьба – как авторское блюдо, совершенство исполнения которого достигается за счет сочетания
            ингредиентов.</p>
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
