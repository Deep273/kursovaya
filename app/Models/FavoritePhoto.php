<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoritePhoto extends Model
{
    protected $primaryKey = 'favorite_photo_id';
    protected $fillable = ['link', 'fk_user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'user_id');
    }
}
