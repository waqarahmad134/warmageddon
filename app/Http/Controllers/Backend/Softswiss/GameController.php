<?php

namespace App\Http\Controllers\backend\Softswiss;

use App\SoftswissGames;
use App\SoftswissGamesCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function categories()
    {
        $categories                  = SoftswissGamesCategory::all();
        return view('backend.softswiss.categories.index',compact('categories'));
    }
    public function add_category()
    {
        return view('backend.softswiss.categories.add');
    }
    public function edit_category($id)
    {
        $category                       = SoftswissGamesCategory::whereId($id)->first();
        return view('backend.softswiss.categories.edit',compact('category'));
    }
    public function save_category(Request $request)
    {
         $input                      = $request->all();
         $cat                        = new SoftswissGamesCategory();
         $cat->name                  = $input['category_name'];
         $cat->status                = $input['category_status'];
        if ($request->file('icon')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->icon->getClientOriginalName();
            $request->icon->move(base_path('softswiss-games/categories'), $icon);
            $cat->image = $icon;
        }
        $cat->save();
        Toastr::success('Game category has been added successfully');
        return redirect('dash-panel/softswiss-categories');
    }
    public function update_category(Request $request)
    {
        $input                      = $request->all();
        $cat                        = SoftswissGamesCategory::whereId($input['catID'])->first();
        $cat->name                  = $input['category_name'];
        $cat->status                = $input['category_status'];
        if ($request->file('icon')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->icon->getClientOriginalName();
            $request->icon->move(base_path('softswiss-games/categories'), $icon);
            $cat->image = $icon;
        }
        $cat->save();
        Toastr::success('Game category has been updated successfully');
        return redirect('dash-panel/softswiss-categories');
    }

    public function games()
    {
       $games                  = SoftswissGames::all();
       return view('backend.softswiss.games.index',compact('games'));
    }
    public function add_game()
    {
        $categories            = SoftswissGamesCategory::where('status',1)->get();
        return view('backend.softswiss.games.add',compact('categories'));
    }
    public function edit_game($id)
    {
        $game                  = SoftswissGames::whereId($id)->first();
        $categories            = SoftswissGamesCategory::where('status',1)->get();
        return view('backend.softswiss.games.edit',compact('categories','game'));
    }
    public function delete_game($id)
    {
       $game                   = SoftswissGames::findorfail($id);
       $game->delete();
       Toastr::success('Game has been deleted');
       return redirect()->back();
    }
    public function save_game(Request $request)
    {
        $request->validate([
            'category'    => 'required',
            'title'       => 'required',
            'identifier'  => 'required',
            'producer'    => 'required',
            'provider'    => 'required',
       ]);
        $input                         = $request->all();
        $game                          = new SoftswissGames();
        $game->category                = $input['category'];
        $game->title                   = $input['title'];
        $game->identifier              = $input['identifier'];
        $game->provider                = $input['provider'];
        $game->producer                = $input['producer'];
        $game->feature_group           = $input['feature_group'];
        $game->meta                    = $input['meta'];
        $game->description             = $input['description'];
        $game->has_freespins           = $input['has_freespins'];
        $game->status                  = $input['status'];
        if ($request->file('icon')) {
            $icon = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'_'.str_random(10). '.' .$request->icon->getClientOriginalName();
            $request->icon->move(base_path('softswiss-games/games'), $icon);
            $game->base_image = $icon;
        }
        $game->save();
        Toastr::success('Game has been added successfully');
        return redirect('dash-panel/softswiss-games');
    }
    public function update_game(Request $request)
    {

    }
}
