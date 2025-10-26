<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCatalog;

class CatalogController extends Controller
{
    public function mens()
    {
        $products = ProductCatalog::where('category', 'Мужская одежда')->get();
        return view('site.mens_clothing', compact('products'));
    }
}
