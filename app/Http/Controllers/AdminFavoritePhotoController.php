<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FavoritePhoto;
use Illuminate\Http\Request;
class AdminFavoritePhotoController
{
    public function index()
    {
        $photos = FavoritePhoto::with('user')
            ->where('status', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('adminpanel.admin_favorite_photos', compact('photos'));
    }

    // Одобрить заявку
    public function approve($id)
    {
        $photo = FavoritePhoto::findOrFail($id);
        $photo->status = true;
        $photo->save();

        return back()->with('success', 'Фото одобрено.');
    }

    // Удалить заявку
    public function destroy($id)
    {
        $photo = FavoritePhoto::findOrFail($id);
        $photo->delete();

        return back()->with('success', 'Заявка удалена.');
    }
}
