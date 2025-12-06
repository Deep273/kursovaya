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

    <aside class="admin-sidebar">
        <div>
            <h2 class="admin-logo">Admin<span>Panel</span></h2>
            <nav class="admin-menu">
                <a href="#" class="active">Услуги</a>
                <a href="{{ route('admin_catalog') }}">Каталог</a>
                <a href="{{ route('admin_favorite_photos') }}">Заявки</a>
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

    <div class="admin-page">
        <h1 class="admin-page-title">Заявки на фото</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="admin-table admin-favorite-photos">
            <div class="admin-table-header">
                <div class="admin-table-cell">Фото</div>
                <div class="admin-table-cell">Пользователь</div>
                <div class="admin-table-cell">Статус</div>
                <div class="admin-table-cell">Дата заявки</div>
                <div class="admin-table-cell">Действия</div>
            </div>

            @foreach($photos as $photo)
                @if(!$photo->status)
                <div class="admin-table-row">
                    <div class="admin-table-cell" style="flex:0 0 80px;">
                        <img src="{{ asset('storage/' . $photo->link) }}" alt="Фото" class="admin-photo-thumb">
                    </div>
                    <div class="admin-table-cell" style="flex:1;">
                        {{ $photo->user->name }} ({{ $photo->user->email }})
                    </div>
                    <div class="admin-table-cell" style="flex:0 0 120px;">
                        В ожидании
                    </div>
                    <div class="admin-table-cell" style="flex:0 0 140px;">
                        {{ $photo->created_at->format('d.m.Y H:i') }}
                    </div>
                    <div class="admin-table-cell" style="flex:0 0 260px;">
                        <div class="admin-actions">
                            <form action="{{ route('admin_favorite_photos.approve', ['id' => $photo->favorite_photo_id]) }}" method="POST" class="inline-form">
                                @csrf
                                <button type="submit" class="btn btn-success">Одобрить</button>
                            </form>

                            <form action="{{ route('admin_favorite_photos.destroy', ['id' => $photo->favorite_photo_id]) }}" method="POST" class="inline-form" onsubmit="return confirm('Удалить заявку?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>

                            <button type="button" class="btn btn-info details-btn" data-photo="{{ asset('storage/' . $photo->link) }}" data-user="{{ $photo->user->name }}" data-email="{{ $photo->user->email }}" data-date="{{ $photo->created_at->format('d.m.Y H:i') }}">
                                Подробнее
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="modal" id="photoDetailsModal">
        <div class="modal-content">
            <h2>Информация о фото</h2>
            <img id="modalPhoto" src="" alt="Фото" class="modal-photo">
            <div class="details-info">
                <div class="details-row"><strong>Пользователь:</strong> <span id="modalUser"></span></div>
                <div class="details-row"><strong>Email:</strong> <span id="modalEmail"></span></div>
                <div class="details-row"><strong>Дата заявки:</strong> <span id="modalDate"></span></div>
            </div>
            <div class="form-buttons">
                <button type="button" class="cancel-btn btn" id="closeModalBtn">Закрыть</button>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('js/favorite_photos_admin.js') }}"></script>

</body>
</html>
