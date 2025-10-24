<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
    // Указываем реальное имя таблицы
    protected $table = 'product_catalog';

    // Первичный ключ
    protected $primaryKey = 'product_catalog_id';

    // Разрешённые для массового заполнения поля
    protected $fillable = ['name', 'description', 'category', 'price'];
}
