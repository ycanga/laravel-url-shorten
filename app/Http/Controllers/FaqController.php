<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faqs;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faqs::where('status', 1)->orderBy('order')->get();

        return response()->json($faqs);
    }
}
