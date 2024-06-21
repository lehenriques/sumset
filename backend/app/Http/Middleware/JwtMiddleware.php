<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;


class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['message' => 'Token inválido.', 'status' => 401]);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json(['message' => 'Token expirado', 'status' => 498]);
            } else {
                return response()->json(['message' => 'Token não encontrado', 'status' => 401]);
            }
        }
        return $next($request);
    }
}
