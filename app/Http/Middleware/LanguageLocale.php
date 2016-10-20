<?php namespace App\Http\Middleware;


// app/Http/Middleware/Language.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageLocale
{
    public function handle($request, Closure $next)
    {
        //var_dump(Session::get('locale'));die;
        if (Session::has('locale') AND array_key_exists(Session::get('locale'), config('app.languages'))) {
            App::setLocale(Session::get('locale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}