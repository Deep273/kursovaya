<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель — Каталог</title>
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
                <a href="{{ route('admin_services') }}">Услуги</a>
                <a href="#" class="active">Каталог</a>
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
            <h1>Управление каталогом</h1>
            <form method="GET" action="{{ route('admin_catalog') }}" class="admin-header-actions">
                <input type="text" name="search" class="admin-search" placeholder="Поиск по названию..." value="{{ request('search') }}">
                <select name="category" class="admin-search">
                    <option value="">Все категории</option>
                    <option value="Мужская одежда" {{ request('category') == 'Мужская одежда' ? 'selected' : '' }}>Мужская одежда</option>
                    <option value="Свадебные платья" {{ request('category') == 'Свадебные платья' ? 'selected' : '' }}>Свадебные платья</option>
                    <option value="Аксессуары" {{ request('category') == 'Аксессуары' ? 'selected' : '' }}>Аксессуары</option>
                    <option value="Украшения и декор" {{ request('category') == 'Украшения и декор' ? 'selected' : '' }}>Украшения и декор</option>
                    <option value="Свадебные кольца" {{ request('category') == 'Свадебные кольца' ? 'selected' : '' }}>Свадебные кольца</option>
                </select>
                <button type="submit" class="admin-add-btn btn">Найти</button>
                <button type="button" class="admin-add-btn btn" id="openAddModalBtn">Добавить товар</button>
            </form>
        </header>

        <!-- Таблица -->
        <section class="admin-table">
            <div class="admin-table-header">
                <span>Имя</span>
                <span>Описание</span>
                <span>Категория</span>
                <span>Цена</span>
                <span>Действия</span>
            </div>

            @forelse ($products as $product)
                <div class="admin-table-row">
                    <span>{{ $product->name }}</span>
                    <span>{{ $product->description }}</span>
                    <span>{{ $product->category }}</span>
                    <span>{{ number_format($product->price, 0, ',', ' ') }} ₽</span>
                    <div class="admin-actions">
                        <!-- Кнопка "Подробнее" -->
                        <button class="admin-details-btn btn" data-name="{{ $product->name }}" data-description="{{ $product->description }}" data-category="{{ $product->category }}" data-price="{{ number_format($product->price, 0, ',', ' ') }} ₽" data-image="{{ asset('storage/' . $product->image) }}">
                            Подробнее
                        </button>

                        <!-- Кнопка "Редактировать" -->
                        <button class="admin-edit-btn btn" data-id="{{ $product->product_catalog_id }}" data-name="{{ $product->name }}" data-description="{{ $product->description }}" data-category="{{ $product->category }}" data-price="{{ $product->price }}" data-route="{{ route('catalog.update', $product->product_catalog_id) }}">
                            Редактировать
                        </button>

                        <!-- Кнопка "Удалить" -->
                        <form method="POST" action="{{ route('catalog.destroy', $product->product_catalog_id) }}" onsubmit="return confirm('Вы уверены, что хотите удалить этот товар?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-delete-btn btn">Удалить</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Товары не найдены.</p>
            @endforelse
        </section>
    </main>
</div>

<!-- Модалка добавления -->
<div class="modal" id="addCatalogModal">
    <div class="modal-content">
        <h2>Добавить товар</h2>
        <form class="catalog-form" method="POST" action="{{ route('catalog.store') }}" enctype="multipart/form-data">
            @csrf

            <label>Имя</label>
            <input type="text" name="name" placeholder="Введите имя" value="{{ old('name') }}" required>
            @error('name')
            <span class="error">{{ $message }}</span>
            @enderror

            <label>Описание</label>
            <textarea name="description" placeholder="Введите описание" required>{{ old('description') }}</textarea>
            @error('description')
            <span class="error">{{ $message }}</span>
            @enderror

            <label>Категория</label>
            <select name="category" required>
                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Выберите категорию</option>
                <option value="Мужская одежда" {{ old('category') == 'Мужская одежда' ? 'selected' : '' }}>Мужская одежда</option>
                <option value="Свадебные платья" {{ old('category') == 'Свадебные платья' ? 'selected' : '' }}>Свадебные платья</option>
                <option value="Аксессуары" {{ old('category') == 'Аксессуары' ? 'selected' : '' }}>Аксессуары</option>
                <option value="Украшения и декор" {{ old('category') == 'Украшения и декор' ? 'selected' : '' }}>Украшения и декор</option>
                <option value="Свадебные кольца" {{ old('category') == 'Свадебные кольца' ? 'selected' : '' }}>Свадебные кольца</option>
            </select>
            @error('category')
            <span class="error">{{ $message }}</span>
            @enderror

            <label>Цена</label>
            <input type="number" name="price" placeholder="Введите цену, ₽" value="{{ old('price') }}" required min="0">
            @error('price')
            <span class="error">{{ $message }}</span>
            @enderror

            <label>Фото товара</label>
            <input type="file" name="image" accept="image/*">
            @error('image')
            <span class="error">{{ $message }}</span>
            @enderror

            <div class="form-buttons">
                <button type="submit" class="save-btn btn">Сохранить</button>
                <button type="button" class="cancel-btn btn" id="closeAddModalBtn">Отмена</button>
            </div>
        </form>
    </div>
</div>

<!-- Модалка редактирования -->
<div class="modal" id="editCatalogModal">
    <div class="modal-content">
        <h2>Редактировать товар</h2>
        <form method="POST" id="editCatalogForm" class="catalog-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="product_catalog_id" id="edit_product_catalog_id">

            <label>Имя</label>
            <input type="text" name="name" id="edit_name" required>

            <label>Описание</label>
            <textarea name="description" id="edit_description" required></textarea>

            <label>Категория</label>
            <select name="category" id="edit_category" required>
                <option value="" disabled>Выберите категорию</option>
                <option value="Мужская одежда">Мужская одежда</option>
                <option value="Свадебные платья">Свадебные платья</option>
                <option value="Аксессуары">Аксессуары</option>
                <option value="Украшения и декор">Украшения и декор</option>
                <option value="Свадебные кольца">Свадебные кольца</option>
            </select>

            <label>Цена</label>
            <input type="number" name="price" id="edit_price" required min="0">

            <label>Фото товара</label>
            <input type="file" name="image" accept="image/*" required>

            <div class="form-buttons">
                <button type="submit" class="save-btn btn">Сохранить</button>
                <button type="button" class="cancel-btn btn" id="closeEditModalBtn">Отмена</button>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="detailsModal">
    <div class="modal-content" style>
        <h2 id="details_name"></h2>
        <img id="details_image" src="" alt="Фото товара">
        <p><strong>Описание:</strong> <span id="details_description"></span></p>
        <p><strong>Категория:</strong> <span id="details_category"></span></p>
        <p><strong>Цена:</strong> <span id="details_price"></span></p>
        <div class="form-buttons">
            <button type="button" class="cancel-btn btn" id="closeDetailsModalBtn">Закрыть</button>
        </div>
    </div>
</div>

<script>
    // Модалка добавления
    const addModal = document.getElementById('addCatalogModal');
    const openAddBtn = document.getElementById('openAddModalBtn');
    const closeAddBtn = document.getElementById('closeAddModalBtn');
    openAddBtn.addEventListener('click', () => addModal.classList.add('show'));
    closeAddBtn.addEventListener('click', () => addModal.classList.remove('show'));
    window.addEventListener('click', e => { if (e.target === addModal) addModal.classList.remove('show'); });

    // Модалка редактирования
    const editModal = document.getElementById('editCatalogModal');
    const editForm = document.getElementById('editCatalogForm');
    const closeEditBtn = document.getElementById('closeEditModalBtn');

    document.querySelectorAll('.admin-edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            editForm.action = btn.dataset.route;
            document.getElementById('edit_product_catalog_id').value = btn.dataset.id;
            document.getElementById('edit_name').value = btn.dataset.name;
            document.getElementById('edit_description').value = btn.dataset.description;
            document.getElementById('edit_category').value = btn.dataset.category;
            document.getElementById('edit_price').value = btn.dataset.price;
            editModal.classList.add('show');
        });
    });

    closeEditBtn.addEventListener('click', () => editModal.classList.remove('show'));
    window.addEventListener('click', e => { if (e.target === editModal) editModal.classList.remove('show'); });

    // Модалка "Подробнее"
    const detailsModal = document.getElementById('detailsModal');
    const closeDetailsBtn = document.getElementById('closeDetailsModalBtn');

    document.querySelectorAll('.admin-details-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('details_name').textContent = btn.dataset.name;
            document.getElementById('details_description').textContent = btn.dataset.description;
            document.getElementById('details_category').textContent = btn.dataset.category;
            document.getElementById('details_price').textContent = btn.dataset.price;
            document.getElementById('details_image').src = btn.dataset.image;
            detailsModal.classList.add('show');
        });
    });

    closeDetailsBtn.addEventListener('click', () => detailsModal.classList.remove('show'));
    window.addEventListener('DOMContentLoaded', () => {
        @if ($errors->any())
        document.getElementById('addCatalogModal').classList.add('show');
        @endif
    });

</script>

</body>
</html>
