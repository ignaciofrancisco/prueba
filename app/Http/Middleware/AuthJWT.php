<?php
namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthJWT
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if(!$token) return response()->json(['error'=>'No autorizado'],401);

        try{
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'),'HS256'));
            $request->user_id = $decoded->sub;
        } catch(\Exception $e){
            return response()->json(['error'=>'Token inválido'],401);
        }
        return $next($request);
    }
}
