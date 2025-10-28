<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование профиля</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<section class="account">
    <h2>Редактирование профиля</h2>

    <div class="profile-avatar">
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}" alt="avatar" class="user-avatar-large">
    </div>

    <form action="{{ route('account.profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
        @csrf

        <div class="form-group">
            <label for="name">Имя</label>
            <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="avatar">Новый аватар</label>
            <input id="avatar" type="file" name="avatar" accept="image/*">
            @error('avatar')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="save-btn">Сохранить изменения</button>
    </form>

    <a href="{{ route('account') }}" class="back-link">← Назад в личный кабинет</a>
</section>
</body>
</html>
