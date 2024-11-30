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
            $url = AllUrls::create([
                'title' => $request->title,
                'url' => $request->url,
                'short_url' => $this->generateShortUrl(),
                'user_id' => auth()->id() ?? $this->getUserIp(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'URL shortened successfully',
                'data' => [
                    'title' => $request->title,
                    'short_url' => env('APP_URL') . '/' . $url->short_url,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to shorten URL',
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
                    'message' => 'URL not found',
                ], 404);
            }

            $url->increment('clicks');

            return response()->json([
                'status' => 'success',
                'message' => 'URL found',
                'data' => [
                    'title' => $url->title,
                    'url' => $url->url,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to find URL',
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
            'message' => 'URLs found',
            'data' => $urls,
        ], 200);
    }
}
