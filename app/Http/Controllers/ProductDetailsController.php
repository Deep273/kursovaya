<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCatalog;

class ProductDetailsController extends Controller
{
    public function index($id)
    {
        $product = ProductCatalog::findOrFail($id); // ищет товар по id
        return view('site.product_details', compact('product'));
    }
}
