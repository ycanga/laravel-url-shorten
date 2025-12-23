<?php

namespace App\Http\Middleware;

use App\Models\ApiKeys;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json([
                'message' => 'API key gerekli'
            ], 401);
        }

        $plainKey = substr($authHeader, 7);
        $hashedKey = hash('sha256', $plainKey);

        $apiKey = ApiKeys::where('key', $hashedKey)
            ->where('is_active', true)
            ->first();

        if (!$apiKey) {
            return response()->json([
                'message' => 'Geçersiz API key'
            ], 401);
        }

        // Son kullanım zamanı
        $apiKey->update([
            'last_used_at' => now()
        ]);

        // Request içine ekle
        $request->merge([
            'api_key' => $apiKey
        ]);

        return $next($request);
    }
}
