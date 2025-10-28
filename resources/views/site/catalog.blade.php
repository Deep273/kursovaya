<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
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
<section class="catalog">
    <h2>Каталог</h2>
    <div class="catalog-blocks">
        <div class="catalog-blocks__block">
            <p class="u-bold d-f a-i_c">01</p>
            <div class="catalog-blocks__block-content">
                <h3>Мужская одежда</h3>
                <p>ЭЛЕГАНТНОСТЬ — именно это слово олицетворяет нашу новую коллекцию! Строгость, утонченность,
                    уверенность и стиль — каждый элемент создан для того, чтобы подчеркнуть индивидуальность
                    мужчины.</p>
                <a href="{{ route('mens_clothing.mens') }}"><button>Подробнее</button></a>
            </div>
            <img src="img/catalog-man-clothes.svg" alt="catalog-man-clothes">
        </div>
        <div class="catalog-blocks__block">
            <p class="u-bold d-f a-i_c">02</p>
            <div class="catalog-blocks__block-content">
                <h3>Свадебные платья</h3>
                <p>РОСКОШНОЕ именно с этим словом ассоциируются платья нашей новой линии... Изящество, легкость,
                    красота и стиль! Тот момент, когда все сложилось идеально!</p>
                <a href="#"><button>Подробнее</button></a>
            </div>
            <img src="img/catalog-wedding-dresses.svg" alt="catalog-wedding-dresses">
        </div>
        <div class="catalog-blocks__block">
            <p class="u-bold d-f a-i_c">03</p>
            <div class="catalog-blocks__block-content">
                <h3>Аксессуары</h3>
                <p>Аксессуары в готическом стиле — это уникальные детали, которые придадут вашему
                    образу таинственность и элегантную мрачность.</p>
                <a href="#"><button>Подробнее</button></a>
            </div>
            <img src="img/catalog-accessories.svg" alt="catalog-accessories">
        </div>
        <div class="catalog-blocks__block">
            <p class="u-bold d-f a-i_c">04</p>
            <div class="catalog-blocks__block-content">
                <h3>Украшения и декор</h3>
                <p>Каждое украшение и элемент декора создаются с учётом вашей индивидуальности и стилистики готической свадьбы, чтобы
                    подчеркнуть неповторимость вашего образа и добавить особую атмосферу таинственности и изящества этому важному дню.</p>
                <a href="#"><button>Подробнее</button></a>
            </div>
            <img src="img/catalog-decorations-and-decor.svg" alt="catalog-decorations-and-decor">
        </div>
        <div class="catalog-blocks__block">
            <p class="u-bold d-f a-i_c">05</p>
            <div class="catalog-blocks__block-content">
                <h3>Свадебные кольца</h3>
                <p> Каждое изделие воплощает в себе уникальность, элегантность и символику вечной любви. Наши
                    мастера-ювелиры, обладая богатым опытом и тонким вкусом, создают не просто украшения, а
                    настоящие произведения искусства.</p>
                <a href="#"><button>Подробнее</button></a>
            </div>
            <img src="img/catalog-wedding-rings.svg" alt="catalog-wedding-rings">
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
</body>

</html>
