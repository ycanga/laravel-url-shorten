<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllUrls;
use App\Models\UrlLogs;
use Illuminate\Support\Facades\DB;

class WebShortenController extends Controller
{
    public function show($shortUrl)
    {
        try {
            $url = AllUrls::where('short_url', $shortUrl)->first();

            if (!$url) {
                return abort(404);
            }

            $url->increment('clicks');

            //Logs can be added here
            DB::beginTransaction();

            try {
                UrlLogs::create([
                    'url_id' => $url->id,
                    'browser' => request()->header('User-Agent'),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

            return redirect($url->url);
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
