<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExemploMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 👉 código executado ANTES da requisição chegar no controller

        return $next($request);

        // 👉 código executado DEPOIS da resposta do controller (opcional)
    }
}
