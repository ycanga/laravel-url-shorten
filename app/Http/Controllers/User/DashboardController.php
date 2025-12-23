<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AllUrls;
use App\Models\UserDomains;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = AllUrls::where('user_id', auth()->id())->with('logs');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('short_url', 'like', "%{$request->search}%")
                    ->orWhere('url', 'like', "%{$request->search}%");
            });
        }

        $urls = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('user.partials.urls-table', compact('urls'))->render();
        }

        return view('user.dashboard', [
            'urls' => $urls,
            'activeDomains' => UserDomains::where('user_id', auth()->id())->get(),
        ]);
    }
}
