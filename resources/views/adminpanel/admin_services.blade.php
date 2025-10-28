<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель — Услуги</title>
    <link rel="stylesheet" href="{{ asset('css/admin-base.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-wrapper">

    <!-- Сайдбар -->
    <aside class="admin-sidebar">
        <div>
            <h2 class="admin-logo">Admin<span>Panel</span></h2>
            <nav class="admin-menu">
                <a href="#" class="active">Услуги</a>
                <a href="{{ route('admin_catalog') }}">Каталог</a>
                <a href="#">Настройки</a>
                <a href="#">Отчёты</a>
            </nav>
        </div>
        <div class="admin-sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="admin-logout-btn btn">Выйти</button>
            </form>
        </div>
    </aside>

    <!-- Основной контент -->
    <main class="admin-content">
        <header class="admin-topbar">
            <h1>Управление услугами</h1>
            <div class="admin-header-actions">
                <form method="GET" action="{{ route('admin_services') }}" class="search-form">
                    <input type="text" name="search" class="admin-search" placeholder="Поиск по названию..." value="{{ request('search') }}">
                    <select name="category" class="admin-search">
                        <option value="">Все категории</option>
                        <option value="Кейтеринг" {{ request('category') == 'Кейтеринг' ? 'selected' : '' }}>Кейтеринг</option>
                        <option value="Церемонии" {{ request('category') == 'Церемонии' ? 'selected' : '' }}>Церемонии</option>
                        <option value="Стилисты и Визажисты" {{ request('category') == 'Стилисты и Визажисты' ? 'selected' : '' }}>Стилисты и Визажисты</option>
                        <option value="Организация" {{ request('category') == 'Организация' ? 'selected' : '' }}>Организация</option>
                        <option value="Фотограф и фотозоны" {{ request('category') == 'Фотограф и фотозоны' ? 'selected' : '' }}>Фотограф и фотозоны</option>
                    </select>
                    <button type="submit" class="admin-add-btn btn">Найти</button>
                </form>
                <button type="button" class="admin-add-btn btn" id="openAddModalBtn">Добавить услугу</button>
            </div>
        </header>

        <!-- Таблица -->
        <section class="admin-table">
            <div class="admin-table-header">
                <span>Название</span>
                <span>Категория</span>
                <span>Цена</span>
                <span>Действия</span>
            </div>

            @foreach ($services as $service)
                <div class="admin-table-row">
                    <span>{{ $service->name }}</span>
                    <span>{{ $service->category }}</span>
                    <span>{{ number_format($service->price, 0, ',', ' ') }} ₽</span>
                    <div class="admin-actions">

                        <!-- Кнопка "Подробнее" -->
                        <button class="admin-details-btn btn"
                                data-name="{{ $service->name }}"
                                data-category="{{ $service->category }}"
                                data-price="{{ number_format($service->price, 0, ',', ' ') }} ₽"
                                data-image="{{ asset('storage/' . $service->image) }}">
                            Подробнее
                        </button>

                        <!-- Кнопка "Редактировать" -->
                        <button class="admin-edit-btn btn"
                                data-id="{{ $service->service_id }}"
                                data-name="{{ $service->name }}"
                                data-category="{{ $service->category }}"
                                data-price="{{ $service->price }}"
                                data-route="{{ route('services.update', $service->service_id) }}">
                            Редактировать
                        </button>

                        <!-- Кнопка "Удалить" -->
                        <form method="POST" action="{{ route('services.destroy', $service->service_id) }}" onsubmit="return confirm('Удалить эту услугу?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-delete-btn btn">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </section>
    </main>
</div>

<!-- Модалка добавления -->
<div class="modal" id="addServiceModal">
    <div class="modal-content">
        <h2>Добавить услугу</h2>
        <form class="service-form" method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
            @csrf
            <label>Название услуги</label>
            <input type="text" name="name" placeholder="Введите название" required>

            <label>Категория</label>
            <select name="category" required>
                <option value="" disabled selected>Выберите категорию</option>
                <option value="Кейтеринг">Кейтеринг</option>
                <option value="Церемонии">Церемонии</option>
                <option value="Стилисты и Визажисты">Стилисты и Визажисты</option>
                <option value="Организация">Организация</option>
                <option value="Фотограф и фотозоны">Фотограф и фотозоны</option>
            </select>

            <label>Цена</label>
            <input type="number" name="price" placeholder="Введите цену, ₽" required min="0">

            <label>Фото услуги</label>
            <input type="file" name="image" accept="image/*">

            <div class="form-buttons">
                <button type="submit" class="save-btn btn">Сохранить</button>
                <button type="button" class="cancel-btn btn" id="closeAddModalBtn">Отмена</button>
            </div>
        </form>
    </div>
</div>

<!-- Модалка "Подробнее" -->
<div class="modal" id="detailsModal">
    <div class="modal-content">
        <h2>Информация об услуге</h2>
        <img id="details_image" src="" alt="Фото услуги">
        <div class="details-info">
            <div class="details-row"><strong>Название:</strong> <span id="details_name"></span></div>
            <div class="details-row"><strong>Категория:</strong> <span id="details_category"></span></div>
            <div class="details-row"><strong>Цена:</strong> <span id="details_price"></span></div>
        </div>
        <div class="form-buttons">
            <button type="button" class="cancel-btn btn" id="closeDetailsModalBtn">Закрыть</button>
        </div>
    </div>
</div>

<script>
    // === Модалка добавления ===
    const addModal = document.getElementById('addServiceModal');
    const openAddBtn = document.getElementById('openAddModalBtn');
    const closeAddBtn = document.getElementById('closeAddModalBtn');
    openAddBtn.addEventListener('click', () => addModal.classList.add('show'));
    closeAddBtn.addEventListener('click', () => addModal.classList.remove('show'));
    window.addEventListener('click', e => { if (e.target === addModal) addModal.classList.remove('show'); });

    // === Модалка "Подробнее" ===
    const detailsModal = document.getElementById('detailsModal');
    const closeDetailsBtn = document.getElementById('closeDetailsModalBtn');

    document.querySelectorAll('.admin-details-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('details_name').textContent = btn.dataset.name;
            document.getElementById('details_category').textContent = btn.dataset.category;
            document.getElementById('details_price').textContent = btn.dataset.price;
            document.getElementById('details_image').src = btn.dataset.image;
            detailsModal.classList.add('show');
        });
    });

    closeDetailsBtn.addEventListener('click', () => detailsModal.classList.remove('show'));
    window.addEventListener('click', e => { if (e.target === detailsModal) detailsModal.classList.remove('show'); });
</script>
</body>
</html>
