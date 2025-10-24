<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class AdminServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Service::query();

        // Поиск по названию
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🏷Фильтр по категории
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
            'category' => 'required|string|in:Кейтеринг,Церемонии,Стилисты и Визажисты,Организация,Фотограф и фотозоны',
            'price' => 'required|numeric|min:0',
        ]);

        Service::create($validated);

        return redirect()->route('admin_services')->with('success', 'Услуга успешно добавлена!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|in:Кейтеринг,Церемонии,Стилисты и Визажисты,Организация,Фотограф и фотозоны',
            'price' => 'required|numeric|min:0',
        ]);

        $service = Service::findOrFail($id);
        $service->update($validated);

        return redirect()->route('admin_services')->with('success', 'Услуга успешно обновлена!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin_services')->with('success', 'Услуга удалена.');
    }

}
