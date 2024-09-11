<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class IsAdministrator
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if($user === null) { return redirect("/"); }
        if($user->email !== self::adminEmail()) { return redirect("/"); }

        return $next($request);
    }

    public static function adminEmail() { return env('ADMIN_EMAIL'); }

    public static function authorize() {

        if(env("APP_ENV") === "local"){ return true; }

        if(!request()->hasHeader("Authorization")) { return false; }
        if(!str_starts_with(request()->header("Authorization"), "Bearer ")) { return false; }

        $token = explode("Bearer ", request()->header('Authorization'))[1];
        $tokenData = PersonalAccessToken::findToken($token);

        if (!$tokenData) { return false; }

        $user = $tokenData->tokenable;
        if(!$user) { return false; }

        return $user->email === self::adminEmail();

    }

}
