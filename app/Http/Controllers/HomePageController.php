<?php

namespace App\Http\Controllers;

use App\Models\UserDomains;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        if(env('APP_SERVICE') == true){
            return view('service');
        }

        $userDomains = auth()->check() ? UserDomains::where('user_id', auth()->id())->orwhere('is_free', true)->get() : UserDomains::where('is_free', true)->get();
        return view('index', compact('userDomains'));
    }
}
