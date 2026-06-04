<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verificamos si está logueado Y si su perfil_id es 1 (Admin)
        if (Auth::check() && Auth::user()->perfil_id == 1) {
            return $next($request); // Le abrimos la puerta del VIP
        }

        // 2. Si no es admin, lo rebotamos a la tienda
        return redirect('/productos');
    }
}