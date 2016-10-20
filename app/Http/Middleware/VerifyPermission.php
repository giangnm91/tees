<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Models\PermissionUser;

class VerifyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*return [
            \Route::getCurrentRoute()->getAction(),
            \Route::currentRouteAction(), 
            \Route::currentRouteName()
        ];*/

        if (auth()->check()) {
            if(auth()->user()->role == 'admin') {
                return $next($request);
            }

            preg_match('/App\\\Http\\\Controllers\\\(.*)\\\([a-zA-Z]+)@(get|post|put|delete)([a-zA-Z]+)/u',\Route::currentRouteAction(), $match);
            if(empty($match)) return view('errors.permission');

            list($full,$ns,$ctrl,$method,$action) = $match;

            $getPermission = PermissionUser::where('group_role',auth()->user()->role)->first(['action.'.$ctrl]);

            if(empty($getPermission) || !isset($getPermission['action'][$ctrl])) {
                return view('errors.permission');
            }

            if(in_array($action, array_values($getPermission['action'][$ctrl]))) {
                return $next($request);
            }

        }
    }
}
