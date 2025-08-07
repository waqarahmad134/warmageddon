<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     *
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('index');
    }

    function cache_clear(){
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        return "Cache is cleared";
    }
}
