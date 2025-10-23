<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $primaryKey = 'feedback_id';
    protected $fillable = ['text', 'date', 'estimation', 'fk_user_id', 'fk_wedding_project_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'user_id');
    }

    public function weddingProject()
    {
        return $this->belongsTo(WeddingProject::class, 'fk_wedding_project_id', 'wedding_project_id');
    }
}
