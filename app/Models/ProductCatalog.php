<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
    protected $primaryKey = 'product_catalog_id';
    protected $fillable = ['name', 'description', 'category', 'price'];
}
