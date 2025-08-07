<?php

namespace App\Http\Controllers\api;

use App\SoftswissGames;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameCallbackController extends Controller
{
    public function session_closed(Request $request)
    {
        \Log::info("session closed callback url run up ");
       $game           = SoftswissGames::where('id',1)->first();
       $game->description = \Opis\Closure\serialize($request->all());
       $game->save();
    }
}
