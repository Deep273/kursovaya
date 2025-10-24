<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
<section class="reviews-start d-f f-d_c a-i_c">
    <p>Veil Of Shadows</p>
    <h1>Отзывы о нашей работе</h1>
    <p>На этой странице вы найдете бесценные отзывы и рекомендации от наших счастливых клиентов, которые доверили
        нам организацию своей свадьбы.</p>
</section>
<section class="reviews">
    <div class="reviews-left-background"></div>
    <div class="reviews-left-border-background"></div>
    <div class="reviews-gray-left-border-background"></div>
    <div class="review d-f">
        <div class="review-photo">
            <p class="d-f a-i_c j-c_c u-bold">1</p>
            <img src="img/review-dmitry-and-daria.svg" alt="dmitry-and-daria">
        </div>
        <div class="review-text">
            <h2>Дмитрий & Дарья</h2>
            <p>Кажется мы ожили от насыщенной недели. <br>
                И хотела сказать огромное спасибо вашей команде! <br>
                Вы сделали наш день очень крутым, мы все получили огромное удовольствием! <br>
                А мы вдвойне, у нас получилосьрасслабиться и отдохнуть на свадьбе (что кажется невозможным). <br>
                И мы правда кайфанули и получили незабываемые эмоции. <br>
                За ваше принятие всех наших хотелок и глупых вопросов, за координацию и полезные советы, за то что
                сразу поняли все наши желания! <br>
                Я все еще под впечатлением насколько детально вы
                подходите ко всему (особенно к площадкам) и это очень круто! <br>
                Надеюсь, что дальше больше, что у вас
                будет еще очень много классных проектов и что вдохновение будет всегда сопровождать вас!
            </p>
            <p>20/08/2023</p>
        </div>
    </div>
    <div class="review d-f">
        <div class="review-photo">
            <p class="d-f a-i_c j-c_c u-bold">2</p>
            <img src="img/review-vlad-and-anna.svg" alt="vlad-and-anna">
        </div>
        <div class="review-text">
            <h2>Влад & Анна</h2>
            <p>В этом свадебном салоне действительно удалось подобрать свадебное платье из своих фантазий. Сказать,
                что я в полнейшем восторге - это не сказать ничего&#41;&#41;&#41; Ассортимент здесь просто
                впечатляющий и сервис
                на высоком уровне. Платье качественное и безумно нежное, а по фигуре село идеально. Огромное Вам
                спасибо за сервис, да и упаковали все аккуратненько&#41;&#41;&#41; <br>
                Хотим выразить огромнейшую благодарность за организацию такого прекрасного нашего первого семейного
                праздника!
            </p>
            <p>18/09/2024</p>
        </div>
    </div>
    <div class="review d-f">
        <div class="review-photo">
            <p class="d-f a-i_c j-c_c u-bold">3</p>
            <img src="img/review-danila-and-ekaterina.svg" alt="danila-and-ekaterina">
        </div>
        <div class="review-text">
            <h2>Данила & Екатерина</h2>
            <p>Veil Of Shadows - отличный свадебный салон! Огромное вам спасибо за организацию нашей свадьбы. Мы с
                Екатериной буквально за 1 месяц нашли площадку и всех членов команды! А дальше просто спокойно
                готовились к свадьбе, команда во всем помогала и поддерживала, я ни о чем не переживал и не
                волновался. <br>
                В общем я в полном восторге от работы, я мечтал в день свадьбы ни о чем не переживать и не думать,
                они помогли этот день провести именно так! Гости тоже были в полном восторге от работы всей команды.
                Абсолютно все оценили и все сказали что вы супер и как хорошо что мы обратились именно к вам за
                помощью!
            </p>
            <p>29/08/24</p>
        </div>
    </div>
</section>
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
