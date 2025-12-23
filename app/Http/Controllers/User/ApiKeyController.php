<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ApiKeys;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apiKeys = ApiKeys::where('user_id', auth()->id())->get();
        return view('user.api-keys', compact('apiKeys'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:50',
            ]);

            $plainKey = 'sk_' . Str::random(40);

            $apiKey = ApiKeys::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'key' => hash('sha256', $plainKey),
                'plan' => 'free',
                'monthly_limit' => 1000, // free plan
                'rate_limit' => 60, // 60 req/min
            ]);

            return response()->json([
                'success' => true,
                'api_key' => $plainKey,
                'key' => [
                    'id' => $apiKey->id,
                    'name' => $apiKey->name,
                    'is_active' => $apiKey->is_active,
                    'last_used_at' => null,
                ]
            ]);
        } catch (\Exception $e) {
            return back()->with(
                'error',
                'API Key oluşturulamadı: ' . $e->getMessage()
            );
        }
    }

    public function destroy($id)
    {
        try {
            $apiKey = ApiKeys::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
            $apiKey->delete();

            return back()->with('success', 'API Key başarıyla silindi.');
        } catch (\Exception $e) {
            return back()->with('error', 'API Key silinemedi: ' . $e->getMessage());
        }
    }
}
