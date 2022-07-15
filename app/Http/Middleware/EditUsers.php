<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //получаю id юзера, который приходит get запросом при переходе по ссылке
        $user = $request->user['id'];

        //если авторизованный юзер совпадает с тем что пришел или же он админ - пропускаем
        if (Auth::check() && Auth::user()->id === $user || Auth::user()->is_admin) {
            return $next($request);
        }

        abort(404);
    }
}
