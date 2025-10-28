<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Портфолио</title>
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
<section class="portfolio">
    <h2>Портфолио</h2>
    <div class="portfolio-block container">
        <div class="portfolio-block__photos d-f">
            <div>
                <img src="img/portfolio-alice.svg" alt="Алиса">
            </div>
            <div class="d-f f-w">
                <div class="d-f">
                    <div><img src="img/portfolio-sofa.svg" alt="Оформление дивана"></div>
                    <div><img src="img/portfolio-alice-table-decoration.svg" alt="Сервировка стола Алисы"></div>
                </div>
                <div class="d-f">
                    <div><img src="img/portfolio-alice-flavour.svg" alt="Букет Алисы"></div>
                    <div><img src="img/portfolio-accessories.svg" alt="Свадебные аксессуары"></div>
                </div>
            </div>
        </div>
        <div class="portfolio-footer d-f s-b">
            <p>Алиса & Сергей</p>
            <p>12 / 06 / 2022</p>
            <a href="#">смотреть подробнее &gt;</a>
        </div>
    </div>
    <div class="portfolio-block container">
        <div class="portfolio-block__photos d-f">
            <div>
                <img src="img/portfolio-seva.svg" alt="Сева">
            </div>
            <div class="d-f f-w">
                <div class="d-f">
                    <div><img src="img/portfolio-seva-and-julia.svg" alt="Сева и Юля"></div>
                    <div><img src="img/portfolio-julia-flavour.svg" alt="Букет Юли"></div>
                </div>
                <div class="d-f">
                    <div><img src="img/portfolio-invitation-letters.svg" alt="Пригласительные письма"></div>
                    <div><img src="img/portfolio-julia-table-decoration.svg" alt="Сервировка стола Юли"></div>
                </div>
            </div>
        </div>
        <div class="portfolio-footer d-f s-b">
            <p>Юля & Сева</p>
            <p>17 / 09 / 2023</p>
            <a href="#">смотреть подробнее &gt;</a>
        </div>
    </div>
    <div class="portfolio-block container">
        <div class="portfolio-block__photos d-f">
            <div>
                <img src="img/portfolio-cris-ivan.svg" alt="Кристина и Иван">
            </div>
            <div class="d-f f-w">
                <div class="d-f">
                    <div><img src="img/portfolio-floristry.svg" alt="Флористика"></div>
                    <div><img src="img/portfolio-cristina.svg" alt="Кристина"></div>
                </div>
                <div class="d-f">
                    <div><img src="img/portfolio-cris-flavour.svg" alt="Букет Кристины"></div>
                    <div><img src="img/portfolio-cris-table-decoration.svg" alt="Сервировка стола Кристины"></div>
                </div>
            </div>
        </div>
        <div class="portfolio-footer d-f s-b">
            <p>Юля & Сева</p>
            <p>17 / 09 / 2023</p>
            <a href="#">смотреть подробнее &gt;</a>
        </div>
    </div>
</section>
<section class="portfolio-mob">
    <h2>Портфолио</h2>
    <div class="portfolio-block container">
        <div class="portfolio-block__photos">
            <div><img src="img/portfolio-alice.svg" alt="Алиса"></div>
            <div><img src="img/portfolio-sofa.svg" alt="Оформление дивана"></div>
            <div><img src="img/portfolio-alice-table-decoration.svg" alt="Сервировка стола Алисы"></div>
            <div><img src="img/portfolio-alice-flavour.svg" alt="Букет Алисы"></div>
            <div><img src="img/portfolio-accessories.svg" alt="Свадебные аксессуары"></div>
        </div>
        <div class="portfolio-footer">
            <p>Алиса & Сергей</p>
            <p>12 / 06 / 2022</p>
            <a href="#">смотреть подробнее &gt;</a>
        </div>
    </div>
    <div class="portfolio-block container">
        <div class="portfolio-block__photos">
            <div><img src="img/portfolio-seva.svg" alt="Сева"></div>
            <div><img src="img/portfolio-seva-and-julia.svg" alt="Сева и Юля"></div>
            <div><img src="img/portfolio-julia-flavour.svg" alt="Букет Юли"></div>
            <div><img src="img/portfolio-invitation-letters.svg" alt="Пригласительные письма"></div>
            <div><img src="img/portfolio-julia-table-decoration.svg" alt="Сервировка стола Юли"></div>
        </div>
        <div class="portfolio-footer">
            <p>Юля & Сева</p>
            <p>17 / 09 / 2023</p>
            <a href="#">смотреть подробнее &gt;</a>
        </div>
    </div>
    <div class="portfolio-block container">
        <div class="portfolio-block__photos">
            <div><img src="img/portfolio-cris-ivan.svg" alt="Кристина и Иван"></div>
            <div><img src="img/portfolio-floristry.svg" alt="Флористика"></div>
            <div><img src="img/portfolio-cristina.svg" alt="Кристина"></div>
            <div><img src="img/portfolio-cris-flavour.svg" alt="Букет Кристины"></div>
            <div><img src="img/portfolio-cris-table-decoration.svg" alt="Сервировка стола Кристины"></div>
        </div>
        <div class="portfolio-footer">
            <p>Юля & Сева</p>
            <p>17 / 09 / 2023</p>
            <a href="#">смотреть подробнее &gt;</a>
        </div>
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
