<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeddingProject;

class WeddingProjectController extends Controller
{
    public function store(Request $request)
    {
        // Базовая валидация
        $request->validate([
            'date' => ['required', 'date', 'after:today'],
            'time' => 'nullable',
        ], [
            'date.required' => 'Выберите дату свадьбы.',
            'date.date' => 'Некорректная дата.',
            'date.after' => 'Вы не можете выбрать сегодняшнюю или прошедшую дату.',
        ]);

        // Проверка на слишком большой год
        $year = date('Y', strtotime($request->date));
        if ($year > 2100) {
            return redirect()->back()
                ->withErrors(['date' => 'Год выбранной даты слишком большой.'])
                ->withInput();
        }

        $userId = Auth::id();

        // Проверка, что у пользователя нет проекта на эту дату
        $existing = WeddingProject::where('fk_user_id', $userId)
            ->whereDate('date', $request->date)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->withErrors(['date' => 'У вас уже есть свадебный проект на эту дату.'])
                ->withInput();
        }

        $project = new WeddingProject();
        $project->fk_user_id = $userId;
        $project->date = $request->date . ($request->time ? ' ' . $request->time : '');
        $project->price = 0;
        $project->save();

        return redirect()
            ->route('project.show', $project->wedding_project_id)
            ->with('success', 'Проект успешно создан!');
    }

    public function show($id)
    {
        $user = Auth::user();
        $project = WeddingProject::where('fk_user_id', $user->user_id)
            ->where('wedding_project_id', $id)
            ->firstOrFail();

        // Общая сумма всех услуг и товаров
        $totalPrice = $project->services()->sum('price') + $project->products()->sum('price');
        $project->price = $totalPrice;
        $project->save();

        return view('site.wedding_project', compact('project', 'user'));
    }

    public function addProduct(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');

        $project = $user->weddingProject;

        if (!$project) {
            return redirect()->back()->with('info', 'Сначала создайте свадебный проект.');
        }

        if ($project->products()->where('fk_product_catalog_id', $productId)->exists()) {
            return redirect()->back()->with('info', 'Этот товар уже добавлен.');
        }

        $project->products()->attach($productId);

        // считаем общую сумму
        $totalPrice = $project->products()->sum('price') + $project->services()->sum('price');
        $project->price = $totalPrice;
        $project->save();

        return redirect()->back()->with('success', 'Товар добавлен в проект и стоимость обновлена!');
    }

    public function addService(Request $request)
    {
        $user = Auth::user();
        $serviceId = $request->input('service_id');

        $project = $user->weddingProject;

        if (!$project) {
            return redirect()->back()->with('info', 'Сначала создайте свадебный проект.');
        }

        if ($project->services()->where('fk_service_id', $serviceId)->exists()) {
            return redirect()->back()->with('info', 'Эта услуга уже добавлена.');
        }

        $project->services()->attach($serviceId);

        // считаем общую сумму
        $totalPrice = $project->products()->sum('price') + $project->services()->sum('price');
        $project->price = $totalPrice;
        $project->save();

        return redirect()->back()->with('success', 'Услуга добавлена в проект и стоимость обновлена!');
    }
}
