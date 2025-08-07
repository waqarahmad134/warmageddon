<?php

namespace App\Http\Controllers\backend\VipLoyalty;

use App\Loyality;
use App\LoyalitySettings;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Image;
use File;
class VipLoyaltyController extends Controller
{
    function general_setting(){
        try {
            $loyalSettings = LoyalitySettings::all();
            $games = DB::table('add_games')->orderBy('order', 'desc')->get();
            return view('backend.vip-loyalty.general_setting', compact('loyalSettings','games'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function general_settingStore(Request $r){
        $r->validate([
            'game' =>'required|integer|min:1|unique:loyality_settings,game_id|',
            'rate' =>'required|min:1|'
        ]);
        try {
            $data = new LoyalitySettings();
            $data->game_id = $r->game;
            $data->rate = $r->rate;
            $data->save();
            Toastr::success('Loyalty percentage added successfully','Success');
            return redirect()->route('admin.general_setting');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function general_setting_Update(Request $r,$id){
        $r->validate([
            'game' =>'required|integer|min:1|unique:loyality_settings,game_id,'. $id,
            'rate' =>'required|min:1|'
        ]);
        try {
            $data = LoyalitySettings::find($id);
            $data->game_id = $r->game;
            $data->rate = $r->rate;
            $data->save();
            Toastr::success('Loyalty percentage updated successfully','Success');
            return redirect()->route('admin.general_setting');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function settng_Edit($id){
        try {
            $loyalSettings = LoyalitySettings::all();
            $edit = LoyalitySettings::find($id);
            $games = DB::table('add_games')->orderBy('order', 'desc')->get();
            return view('backend.vip-loyalty.general_setting', compact('loyalSettings','edit','games'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function settng_status($id){
        $user = LoyalitySettings::find($id);
        if($user->status== 1){
            $user->status = 0;
            $msg = 'Setting ban successfully !';
        }else{
            $user->status = 1;
            $msg = 'Setting active successfully !';
        }
        $user->save();
        Toastr::success($msg,'Success');
        return redirect()->back();
    }
    function settng_delete($id){
        try {
            $data = LoyalitySettings::find($id);
            $data->delete();
            Toastr::success('Loyalty percentage deleted!','Success');
            return redirect()->route('admin.general_setting');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    // Loyalty
    function index(){
        try {
            $data = Loyality::orderBy('id','asc')->get();
            return view('backend.vip-loyalty.index',compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function loyality_add(){
        try {
            return view('backend.vip-loyalty.loyaltyadd');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function loyality_Store(Request $r){
        //dd($r->all());
        $r->validate([
            'name' =>'required|unique:loyalities,name|',
            'from_range' =>'required|integer|min:0|',
            'to_range' =>'required|integer|min:1|',
            /*'conversion_rate' =>'required|min:0|',*/
            'loyalty_multiplier' =>'required|min:0|',
            'status' =>'required|integer|',
            'base_image' => 'mimes:jpeg,jpg,png|required|dimensions:width=250,height=250'

        ]);
        try {
            $data = new Loyality();
            $data->name = $r->name;
            $data->from_range = $r->from_range;
            $data->to_range = $r->to_range;
            $data->conversion_rate = $r->conversion_rate;
            $data->loyalty_multiplier = $r->loyalty_multiplier;
            $data->status = $r->status;

            $data->save();

            if($r->hasFile('base_image')){
                $file = $r->file('base_image');
                $images = Image::make($file)->resize(300, 300)->insert($file,'center');
                $pathImage = 'public/uploads/loyalty/';
                if (!file_exists($pathImage)){
                    mkdir($pathImage, 0777, true);
                    $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $images->save('public/uploads/loyalty/'.$name);
                    $data->base_image =  'public/uploads/loyalty/'.$name;
                }else{
                    $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $images->save('public/uploads/loyalty/'.$name);
                    $data->base_image =  'public/uploads/loyalty/'.$name;
                }
                $data->save();

            }
            Toastr::success('Loyalty tier added successfully','Success');
            return redirect()->route('admin.loyality_list');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function loyalty_Edit($id){
        try {
            $edit = Loyality::find($id);
            return view('backend.vip-loyalty.loyaltyadd', compact('edit'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function loyality_Update(Request $r,$id){
        //dd($r->all());
        $r->validate([
            'name' =>'required|unique:loyalities,name,'.$id,
            'from_range' =>'required|integer|min:0|',
            'to_range' =>'required|integer|min:1|',
            'status' =>'required|integer|min:1|',
            'base_image' => 'mimes:jpeg,jpg,png|sometimes|nullable|dimensions:width=250,height=250'

        ]);
        try {
            $data = Loyality::find($id);
            $data->name = $r->name;
            $data->from_range = $r->from_range;
            $data->to_range = $r->to_range;
            $data->status = $r->status;
            $data->save();

            if($r->hasFile('base_image')){
                $file = $r->file('base_image');
                $images = Image::make($file)->resize(300, 300)->insert($file,'center');
                $pathImage = 'public/uploads/loyalty/';
                if (!file_exists($pathImage)){
                    mkdir($pathImage, 0777, true);
                    $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $images->save('public/uploads/loyalty/'.$name);
                    $data->base_image =  'public/uploads/loyalty/'.$name;
                }else{
                    $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    if (file_exists($data->base_image)) {
                        File::delete($data->base_image);
                    }
                    $images->save('public/uploads/loyalty/'.$name);
                    $data->base_image =  'public/uploads/loyalty/'.$name;
                }
                $data->save();

            }
            Toastr::success('Loyalty tier added successfully','Success');
            return redirect()->route('admin.loyality_list');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }
    function Loyalty_status($id){
        $user = Loyality::find($id);
        if($user->status== 1){
            $user->status = 0;
            $msg = 'Loyalty banned successfully !';
        }else{
            $user->status = 1;
            $msg = 'Loyalty tier activated successfully !';
        }
        $user->save();
        Toastr::success($msg,'Success');
        return redirect()->back();
    }
    function loyalty_delete($id){
        try {
            $data = Loyality::find($id);
            if (file_exists($data->base_image) && $data->base_image != 'public/uploads/loyalty/demo/actab-icon1.png') {
                File::delete($data->base_image);
            }
            $data->delete();
            Toastr::success('loyalty tier deleted successfully','Success');
            return redirect()->route('admin.loyality_list');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! Try again');
            return redirect()->back();
        }
    }


}
