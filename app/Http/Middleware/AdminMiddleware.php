<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Если пользователь не авторизован или его роль не admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Редирект на главную страницу или страницу ошибки
            return redirect()->route('main')->with('error', 'У вас нет прав для доступа в админ-панель.');
        }
        return $next($request);
    }
}
