<?php

namespace App\Http\Controllers\Backend;

use App\LoggedinHistoryUser;
use App\User;
use App\VisitorHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {

//      $visitor_history               = VisitorHistory::all();
//      $logged_in_users               = collect();
//      $users                         = LoggedinHistoryUser::with('user')->get();
//      foreach ($users as $user)
//      {
//        if ($user->user!=null)
//          if ($user->user->last_login_ip!=false && $user->user->last_login_ip!=null)
//          {
//
//              $position = \Location::get($user->last_login_ip);
//              $logged_in_users->push([
//                  'region'      => $position->cityName,
//                  'latitude'   => $position->latitude,
//                  'longitude'  => $position->longitude
//              ]);
//          }
//
//      }
      return view('backend.home');
    }

}
