<?php

namespace App\Http\Middleware;

use Closure;

class checkIfFrend
{

    public function handle($request, Closure $next)
    {
        // проверка на 'друга'
        if ($request-> status) {
            // перехватываем запрос если уже была заявка
            return redirect('lk');
        }
        return $next($request);
    }
}
