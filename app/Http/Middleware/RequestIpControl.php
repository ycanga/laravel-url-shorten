<?php

namespace App\Http\Middleware;

use App\Models\AllUrls;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestIpControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $this->controlRequestIp($request, $next);

        return $next($request);
    }

    public function controlRequestIp(Request $request)
    {
        $reqCount = AllUrls::where('user_id', $request->ip())
            ->whereDate('created_at', today())
            ->count();

        if($reqCount == env('FREE_REQUEST_PER_DAY_LIMIT')) {
            abort(429, 'You have reached the maximum number of requests allowed per day.');
        }
    }
}
