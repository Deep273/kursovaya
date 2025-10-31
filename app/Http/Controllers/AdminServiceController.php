<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class AdminServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $services = $query->get();

        return view('adminpanel.admin_services', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string',
            'price' => 'required|min:0|max:99999999.99',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Введите название услуги.',
            'name.max' => 'Название не может превышать 100 символов.',
            'category.required' => 'Выберите категорию услуги.',
            'price.required' => 'Введите цену услуги.',
            'price.min' => 'Цена не может быть меньше 0 ₽.',
            'price.max' => 'Цена не может превышать 99 999 999,99 ₽.',
            'image.required' => 'Обложка услуги обязательна.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Допустимые форматы: jpg, jpeg, png, webp.',
            'image.max' => 'Размер изображения не должен превышать 2MB.',
        ]);

        $validated['price'] = (float) $validated['price'];
        if ($validated['price'] > 99999999.99) {
            return redirect()->back()
                ->withErrors(['price' => 'Цена не может превышать 99 999 999,99 ₽.'])
                ->withInput();
        }

        // Сохраняем файл
        $path = $request->file('image')->store('service_images', 'public');
        $validated['image'] = $path;

        Service::create($validated);

        return redirect()->route('admin_services')->with('success', 'Услуга успешно добавлена!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string',
            'price' => 'required|min:0|max:99999999.99',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // при обновлении можно не менять
        ], [
            'name.required' => 'Введите название услуги.',
            'name.max' => 'Название не может превышать 100 символов.',
            'category.required' => 'Выберите категорию услуги.',
            'price.required' => 'Введите цену услуги.',
            'price.min' => 'Цена не может быть меньше 0 ₽.',
            'price.max' => 'Цена не может превышать 99 999 999,99 ₽.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Допустимые форматы: jpg, jpeg, png, webp.',
            'image.max' => 'Размер изображения не должен превышать 2MB.',
        ]);

        $service = Service::findOrFail($id);

        $validated['price'] = (float) $validated['price'];
        if ($validated['price'] > 99999999.99) {
            return redirect()->back()
                ->withErrors(['price' => 'Цена не может превышать 99 999 999,99 ₽.'])
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('service_images', 'public');
            $validated['image'] = $path;
        }

        $service->update($validated);

        return redirect()->route('admin_services')->with('success', 'Услуга успешно обновлена!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin_services')->with('success', 'Услуга успешно удалена.');
    }
}
