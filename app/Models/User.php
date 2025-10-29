<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
    protected $fillable = ['name', 'email', 'number_phone', 'password', 'role', 'avatar'];

    public function weddingProject()
    {
        return $this->hasOne(WeddingProject::class, 'fk_user_id', 'user_id');
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'fk_user_id', 'user_id');
    }

    public function favoritePhotos()
    {
        return $this->hasMany(FavoritePhoto::class, 'fk_user_id', 'user_id');
    }
}
