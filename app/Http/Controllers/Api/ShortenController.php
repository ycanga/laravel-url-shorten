<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreShortenRequest;
use App\Models\AllUrls;
use App\Http\Controllers\FunctionsTrait;

class ShortenController extends Controller
{
    use FunctionsTrait;

    public function store(StoreShortenRequest $request)
    {
        $request->validated();

        try {
            $shortUrl = $this->generateShortUrl();
            
            $url = AllUrls::create([
                'title' => $request->title,
                'url' => $request->url,
                'short_url' => $shortUrl,
                'channel' => request()->is('api/*') ? 'api' : 'web' ?? null,
                'user_id' => auth()->id() ?? $this->getUserIp(),
            ]);

            //! Dönen domain kontrol edilmeli.
            return response()->json([
                'status' => 'success',
                'message' => __('home/home.shorten.created'),
                'data' => [
                    'title' => $request->title,
                    'short_url' => $request->domain .'/'. $shortUrl,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => __('home/home.shorten.creation_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the shortened URL.
     *
     * @param string $shortUrl
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($shortUrl)
    {
        try {
            $url = AllUrls::where('short_url', $shortUrl)->first();
            
            if (!$url) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('home/home.shorten.not_found'),
                ], 404);
            }

            $url->increment('clicks');

            return response()->json([
                'status' => 'success',
                'message' => __('home/home.shorten.found'),
                'data' => [
                    'title' => $url->title,
                    'url' => $url->url,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => __('home/home.shorten.not_found'),
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Show all shortened URLs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $urls = AllUrls::all();

        return response()->json([
            'status' => 'success',
            'message' => __('home/home.shorten.found'),
            'data' => $urls,
        ], 200);
    }
}
