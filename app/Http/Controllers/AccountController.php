<?php

namespace App\Http\Controllers;

use App\Models\FavoritePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeddingProject;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
   public function index()
   {
       $user = Auth::user();

       // Свадебный проект пользователя
       $userProject = $user->weddingProject; // связь hasOne в модели User

       // Избранные фото
       $favoritePhotosAll = FavoritePhoto::where('fk_user_id', $user->user_id)->get();
       $favoriteApproved = FavoritePhoto::where('fk_user_id', $user->user_id)
           ->where('status', true)
           ->get();
       $favoritePending = FavoritePhoto::where('fk_user_id', $user->user_id)
           ->where('status', false)
           ->get();

       return view('site.account', compact(
           'user',
           'userProject',
           'favoritePhotosAll',
           'favoriteApproved',
           'favoritePending'
       ));
    }


    public function profile()
    {
        $user = Auth::user();
        return view('site.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->user_id . ',user_id',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // только картинки, макс. 2 МБ
        ], [
            'name.required' => 'Введите имя.',
            'name.unique' => 'Это имя уже занято другим пользователем.',
            'avatar.image' => 'Файл должен быть изображением.',
            'avatar.mimes' => 'Допустимые форматы: jpg, jpeg, png, gif.',
            'avatar.max' => 'Размер файла не должен превышать 2 МБ.',
        ]);

        $user->name = $data['name'];

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('account')->with('account_success', 'Профиль обновлён!');
    }

    public function addFavorite(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120', // до 5 МБ
        ], [
            'photo.required' => 'Выберите фото для загрузки.',
            'photo.image' => 'Файл должен быть изображением.',
            'photo.mimes' => 'Допустимые форматы: jpg, jpeg, png, gif.',
            'photo.max' => 'Максимальный размер файла — 5 МБ.',
        ]);

        $userId = Auth::user()->user_id;

        // Загрузка файла
        $path = $request->file('photo')->store('favorite_photos', 'public');

        FavoritePhoto::create([
            'fk_user_id' => $userId,
            'link' => $path,   // сохраняем путь к файлу в поле "link"
            'status' => false, // ожидает проверки
        ]);

        return back()->with('favorite_success', 'Фото отправлено на проверку!');
    }

}
