<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetApiLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next)
    {
        $locale = $request->header('Accept-Language')
        ?? session('locale')
        ?? config('app.locale');

        $locale = explode(',', $locale)[0];
        
        $locale = str_replace('_', '-', $locale);
        $locale = explode('-', $locale)[0];
        
        if (!in_array($locale, config('app.supported_locales', ['en','tr']))) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
