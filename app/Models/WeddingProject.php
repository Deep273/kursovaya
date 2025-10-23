<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeddingProject extends Model
{
    protected $primaryKey = 'wedding_project_id';
    protected $fillable = ['date', 'price', 'fk_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'user_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'fk_wedding_project_id', 'wedding_project_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'wedding_project_services', 'fk_wedding_project_id', 'fk_service_id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductCatalog::class, 'wedding_project_product_catalog', 'fk_wedding_project_id', 'fk_product_catalog_id');
    }
}
