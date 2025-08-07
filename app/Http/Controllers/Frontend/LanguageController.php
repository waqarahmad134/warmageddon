<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Session;
use Config;
class LanguageController extends Controller
{
    public function language($lang)
    {
        Session::put('locale',$lang);
        App::setlocale($lang);
        return redirect('/');
    }
}
