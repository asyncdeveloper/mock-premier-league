<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
		} catch (Exception $e) {
			if ($e instanceof TokenInvalidException){
				return response()->json(['errors' => 'Token is Invalid']);
			} else if ($e instanceof TokenExpiredException){
				return response()->json(['errors' => 'Token is Expired']);
			} else{
				return response()->json(['errors' => 'Authorization Token not found']);
			}
		}
        return $next($request);
    }
}
