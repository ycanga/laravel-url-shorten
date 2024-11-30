<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllUrls;

class ShortenController extends Controller
{
    public function show($shortUrl)
    {
        try {
            $url = AllUrls::where('short_url', $shortUrl)->first();

            if (!$url) {
                return abort(404);
            }

            $url->increment('clicks');

            return redirect($url->url);
        } catch (\Exception $e) {
            return abort(500);
        }
    }
}
