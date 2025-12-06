<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with('user')->latest()->get();

        return view('site.feedback', compact('feedback'));
    }

    public function store(Request $request)
    {
        // Получаем свадебный проект текущего пользователя
        $weddingProject = Auth::user()->weddingProject; // связь в модели User: weddingProject()

        if (!$weddingProject) {
            // Проект не создан — возвращаем с ошибкой
            return back()->withErrors(['no_project' => 'Сначала создайте свадебный проект, чтобы оставить отзыв.']);
        }

        // Валидация формы
        $request->validate([
            'estimation' => 'required|integer|min:1|max:5',
            'text'       => 'required|string|max:2000',
        ]);

        // Создание отзыва
        Feedback::create([
            'text' => $request->text,
            'date' => now(),
            'estimation' => $request->estimation,
            'fk_user_id' => Auth::id(),
            'fk_wedding_project_id' => $weddingProject->wedding_project_id,
        ]);

        return back()->with('success', 'Спасибо за ваш отзыв!');
    }

}

