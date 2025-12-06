<?php


namespace App\Http\Controllers;

use App\Models\ProductCatalog;

class ProductCatalogController extends Controller
{
    public function category($category)
    {
        $titles = [
            'mens_clothing' => 'Мужская одежда',
            'wedding_dresses' => 'Свадебные платья',
            'accessories' => 'Аксессуары',
            'decor' => 'Украшения и декор',
            'rings' => 'Свадебные кольца'
        ];

        if (!array_key_exists($category, $titles)) {
            abort(404);
        }

        $products = ProductCatalog::where('category', $titles[$category])
            ->where('archived', false) // исключаем архивированные товары
            ->get();

        return view('site.category_catalog', [
            'products' => $products,
            'title' => $titles[$category]
        ]);
    }
}
