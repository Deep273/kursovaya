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
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|min:0|max:99999999.99',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // не более 2MB
        ], [
            'name.required' => 'Введите название товара.',
            'name.max' => 'Название не должно превышать 50 символов.',
            'description.required' => 'Введите описание товара.',
            'category.required' => 'Выберите категорию.',
            'price.required' => 'Введите цену.',
            'price.min' => 'Цена не может быть меньше 0 ₽.',
            'price.max' => 'Цена не может превышать 99 999 999,99 ₽.',
            'image.required' => 'Обложка товара обязательна.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Разрешены только форматы jpg, jpeg, png, webp.',
            'image.max' => 'Размер изображения не должен превышать 2MB.',
        ]);

        $validated['price'] = (float) $validated['price'];
        if ($validated['price'] > 99999999.99) {
            return redirect()->back()
                ->withErrors(['price' => 'Цена не может превышать 99 999 999,99 ₽.'])
                ->withInput();
        }

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
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|min:0|max:99999999.99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Введите название товара.',
            'name.max' => 'Название не должно превышать 50 символов.',
            'description.required' => 'Введите описание товара.',
            'category.required' => 'Выберите категорию.',
            'price.required' => 'Введите цену.',
            'price.min' => 'Цена не может быть меньше 0 ₽.',
            'price.max' => 'Цена не может превышать 99 999 999,99 ₽.',

            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Разрешены только форматы jpg, jpeg, png, webp.',
            'image.max' => 'Размер изображения не должен превышать 2MB.',
        ]);

        $product = ProductCatalog::findOrFail($id);

        $validated['price'] = (float) $validated['price'];
        if ($validated['price'] > 99999999.99) {
            return redirect()->back()
                ->withErrors(['price' => 'Цена не может превышать 99 999 999,99 ₽.'])
                ->withInput();
        }

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
