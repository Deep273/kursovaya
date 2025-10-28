<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veil Of Shadows</title>
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
<section class="welcome d-f a-i_c">
    <div class="container">
        <h1>Добро пожаловать на мир готической свадьбы</h1>
        <p>Погрузитесь в атмосферу таинственности и романтики, где мы предлагаем вам незабываемое событие,
            наполненное очарованием готической эстетики</p>
        <button>Узнать больше</button>
    </div>
</section>
<section class="wedding-planning container">
    <div class="wedding-planning-inside">
        <div class="wedding-planning-inside__container">
            <h1>Планирование свадьбы</h1>
            <p>С чего начать организацию свадьбы - получить доступ к удобному планировщику и самостоятельно
                распределить бюджет</p>
            <div class="wedding-planning-buttons d-f">
                <button class="u-bold">Подробнее</button>
                <button class="u-bold">Получить доступ</button>
            </div>
        </div>
    </div>
    <div class="wedding-planning-outside d-f j-c_c">
        <div class="wedding-planning-outside__block d-f f-d_c a-i_c">
            <img src="img/heart.png" alt="heart">
            <p>Планирование свадьбы</p>
        </div>
        <div class="wedding-planning-outside__block d-f f-d_c a-i_c">
            <img src="img/helper.png" alt="helper">
            <p>Помощь свадебного координата</p>
        </div>
        <div class="wedding-planning-outside__block d-f f-d_c a-i_c">
            <img src="img/airplane.png" alt="airplane">
            <p>Организация свадьбы под ключ</p>
        </div>
    </div>
</section>
<section class="about-us">
    <h2>О нас</h2>
    <div class="about-us__blocks container d-f s-b f-w">
        <div class="d-f f-d_c">
            <div class="d-f f-d_c a-i_c j-c_c">
                <p>8</p>
                <p>лет непрерывной работы в сфере организации мероприятий</p>
            </div>
            <div class="d-f f-d_c a-i_c j-c_c">
                <p>250+</p>
                <p>человек — самый большой проект по численности</p>
            </div>
        </div>
        <div class="d-f f-d_c">
            <div class="d-f f-d_c a-i_c j-c_c">
                <p>200</p>
                <p>реализованных мероприятий и 100% довольных клиентов</p>
            </div>
            <div class="d-f f-d_c a-i_c j-c_c">
                <p>65</p>
                <p>человек — самый большой состав команды на одном из проектов</p>
            </div>
        </div>
        <div class="d-f f-d_c">
            <div class="d-f f-d_c j-c_c">
                <h2>Об Veil Of Shadows</h2>
                <p>Более 7 лет команда создает красивые свадебные и семейные события.</p>
                <p>На нашем счету более 200 организованных мероприятий.</p>
                <p>Наша основная задача — помочь вам определиться в многообразии стилей, пожеланий, соединить все в
                    одно целое, обеспечить спокойствием и комфортом вас как на протяжении подготовки.</p>
                <button>Подробнее</button>
            </div>
        </div>
    </div>
</section>
<section class="feedback-form d-f f-d_c a-i_c">
    <h1>Заполните форму и мы подберём площадку для вашей свадьбы и рассчитаем смету.</h1>
    <p>Заполните форму и мы свяжемся с вами в ближайшее время. Оставляя заявку, вы даете согласие на обработку ваших
        персональных данных в соответствии с политикой конфиденциальности.</p>
    <form class="d-f j-c_c f-w">
        <input type="text" placeholder="Как к вам обращаться?">
        <input type="tel" placeholder="Ваш номер телефона">
        <button type="submit">Отправить</button>
    </form>
</section>
<section class="indispensable">
    <div class="indispensable-border">
        <h2>Незаменимый свадебный помощник</h2>
        <div class="indispensable-blocks d-f j-c_c">
            <div class="d-f f-d_c a-i_c">
                <img src="img/calc.svg" alt="calc">
                <p class="u-bold">Стоимость свадьбы</p>
                <p>Автоматическое добавление в смету выбранных Вами товаров и услуг</p>
            </div>
            <div class="d-f f-d_c a-i_c">
                <img src="img/guest_list.svg" alt="guest_list">
                <p class="u-bold">Список гостей</p>
                <p>Удобный сервис учета тех, кто приглашен и кто придет</p>
            </div>
            <div class="d-f f-d_c a-i_c">
                <img src="img/sails.svg" alt="sails">
                <p class="u-bold">Акции и подарки</p>
                <p>Все выгодные предложения, собранные для Вас на одной странице</p>
            </div>
            <div class="d-f f-d_c a-i_c">
                <img src="img/marriage-registry.svg" alt="marriage-registry">
                <p class="u-bold">Выбор ЗАГСа</p>
                <p>Адреса, фотографии, описания и актуальные отзывы молодоженов</p>
            </div>
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
