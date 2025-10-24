<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCatalog;

class AdminCatalogController extends Controller
{
    // Страница каталога
    public function index(Request $request)
    {
        $query = ProductCatalog::query();

        // Фильтрация по названию
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷Фильтрация по категории
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->get();

        return view('adminpanel.admin_catalog', compact('products'));
    }


    // Добавление товара
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
        ]);

        ProductCatalog::create($validated);

        return redirect()->route('admin_catalog')->with('success', 'Товар успешно добавлен!');
    }

    // Удаление
    public function destroy($id)
    {
        $product = ProductCatalog::findOrFail($id);
        $product->delete();

        return redirect()->route('admin_catalog')->with('success', 'Товар успешно удалён!');
    }

    // Редактирование (модалка не требует отдельной страницы)
    public function edit($id)
    {
        $product = ProductCatalog::findOrFail($id);
        return view('adminpanel.admin_catalog', compact('product'));
    }

    // Обновление товара
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
        ]);

        $product = ProductCatalog::findOrFail($id);
        $product->update($validated);

        return redirect()->route('admin_catalog')->with('success', 'Товар успешно обновлён!');
    }
}
