<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role !== StatusEnum::ADMIN->value){
            return response()->json(['message' => 'Usuário sem permissão', 'status' => 403]);
        }
        return $next($request);
    }
}
