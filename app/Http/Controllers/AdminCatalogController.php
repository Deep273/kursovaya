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

        // Фильтрация по категории
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // проверка файла
        ]);

        // Если есть загруженное фото — сохраняем
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('catalog_images', 'public');
            $validated['image'] = $path;
        }

        ProductCatalog::create($validated);

        return redirect()->route('admin_catalog')->with('success', 'Товар успешно добавлен!');
    }

    // Обновление товара
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = ProductCatalog::findOrFail($id);

        // Если пользователь загрузил новое фото — заменяем
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('catalog_images', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('admin_catalog')->with('success', 'Товар успешно обновлён!');
    }

    // Удаление
    public function destroy($id)
    {
        $product = ProductCatalog::findOrFail($id);
        $product->delete();

        return redirect()->route('admin_catalog')->with('success', 'Товар успешно удалён!');
    }
}
