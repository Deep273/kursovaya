<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeddingProject;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userProject = $user->weddingProject; // вместо where()
        return view('site.account', compact('user', 'userProject'));
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

        return redirect()->route('account')->with('success', 'Профиль обновлён!');
    }

}
