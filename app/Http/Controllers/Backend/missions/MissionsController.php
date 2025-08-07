<?php

namespace App\Http\Controllers\backend\missions;

use App\MisssionType;
use App\UserMission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MissionBonus;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Image;
use File;

class MissionsController extends Controller
{
    function missionList(){
        try {
            $data =MissionBonus::orderBy('id','asc')->get();
            return view('backend.missions.index', compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    public function usermission()
    {
        $user_missions                   = UserMission::with('MissionBonus','user')->get();
        return view('backend.missions.userMissions',compact('user_missions'));
    }
    function create(){
        $type = MisssionType::latest()->get();
        return view('backend.missions.add',compact('type'));
    }
    function store(Request $r){
        if (@$r->specific_day) {
            $r->validate([
                'name' => 'required',
                'prize' => 'required',
                'amount' => 'required',
                'total_spin' => 'required',
                'wager_amount' => 'required',
                'specific_day' => 'required',
                'status' => 'required',
                'text' => 'required',
                'base_image' => 'mimes:jpeg,jpg,png|required|dimensions:width=250,height=250'
            ]);
        }else {
            $r->validate([
                'name' => 'required',
                'prize' => 'required',
                'total_spin' => 'required',
                'wager_amount' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'text' => 'required',
                'status' => 'required',
                'base_image' => 'mimes:jpeg,jpg,png|required|dimensions:width=250,height=250'
            ]);
        }

        if ($r->wager_amount==0 && $r->total_spin==0)
        {
            Toastr::error('Either amount or total spins should be greater than 0');
            return redirect()->back()->with('amount_check','Either amount or total spins should be greater than 0');
        }
        try {
            //  dd($r->all());
            $data = new MissionBonus();
            $data->name = $r->name;
            $data->prize = $r->prize;
            $data->amount = $r->amount;
            $data->text = $r->text;
            $data->total_spin = $r->total_spin;
            $data->wager_amount = $r->wager_amount;
            if (@$r->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($r->specific_day));
            }
            if (@$r->date) {
                $data->date_m = $r->date;
            }
            if (@$r->week) {
                $data->d_m = $r->week;
            }
            if (@$r->day) {
                $data->d_m = $r->day;
            }
            $data->status = $r->status;
            $data->save();
            if($r->hasFile('base_image')){
                $file = $r->file('base_image');
                $images = Image::make($file)->insert($file,'center');
                $pathImage = 'public/uploads/mission/';
                if (!file_exists($pathImage)){
                    mkdir($pathImage, 0777, true);
                    $name =(Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $images->save('public/uploads/mission/'.$name);
                    $data->base_image =  'public/uploads/mission/'.$name;
                }else{
                    $name =(Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $images->save('public/uploads/mission/'.$name);
                    $data->base_image =  'public/uploads/mission/'.$name;
                }
                $data->save();

            }
            Toastr::success('Opreation successfully','Success');
            return redirect()->route('admin.mission_list');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    public function status_change($id){
        $user = MissionBonus::find($id);
        if($user->status==1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        Toastr::success('Opreation successfully','Success');
        return redirect()->back();
    }

    function show($id){
        $mission = MissionBonus::find($id);
        return view('backend.missions.show', compact('mission'));
    }
    function edit($id){
        $edit = MissionBonus::find($id);
        $type = MisssionType::latest()->get();
        return view('backend.missions.add', compact('edit','type'));
    }
    function update(Request $r,$id){
        if (@$r->specific_day) {
            $r->validate([
                'name' => 'required',
                'prize' => 'required',
                'amount' => 'required',
                'specific_day' => 'required',
                'text' => 'required',
                'total_spin' => 'required',
                'wager_amount' => 'required',
                'status' => 'required',
                'base_image' => 'mimes:jpeg,jpg,png|sometimes|nullable|dimensions:width=250,height=250'
            ]);
        }else {
            $r->validate([
                'name' => 'required',
                'prize' => 'required',
                'text' => 'required',
                'total_spin' => 'required',
                'wager_amount' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'week' => 'required',
                'status' => 'required',
                'base_image' => 'mimes:jpeg,jpg,png|sometimes|nullable|dimensions:width=250,height=250'
            ]);
        }
        try {
            //  dd($r->all());
            $data = MissionBonus::find($id);
            $data->name = $r->name;
            $data->prize = $r->prize;
            $data->text = $r->text;
            $data->amount = $r->amount;
            $data->total_spin = $r->total_spin;
            $data->wager_amount = $r->wager_amount;
            if (@$r->specific_day) {
                $data->specific_day = date('y-m-d',strtotime($r->specific_day));
            }
            if (@$r->date) {
                $data->date_m = $r->date;
            }
            if (@$r->week) {
                $data->d_m = $r->week;
            }
            $data->status = $r->status;
            $data->save();
            if($r->hasFile('base_image')){
                $file = $r->file('base_image');
                $images = Image::make($file)->insert($file,'center');
                $pathImage = 'public/uploads/mission/';
                if (!file_exists($pathImage)){
                    mkdir($pathImage, 0777, true);
                    $name =(Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    $images->save('public/uploads/mission/'.$name);
                    $data->base_image =  'public/uploads/mission/'.$name;
                }else{
                    $name =(Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                    if (file_exists($data->base_image)) {
                        File::delete($data->base_image);
                    }
                    $images->save('public/uploads/mission/'.$name);
                    $data->base_image =  'public/uploads/mission/'.$name;
                }
                $data->save();
            }
            Toastr::success('Opreation successfully','Success');
            return redirect()->route('admin.mission_list');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong! please try again','Error');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        $data = MissionBonus::find($id);
        if (file_exists($data->base_image) && $data->base_image != 'public/uploads/mission/demo/mission-icon1.png' ) {
            File::delete($data->base_image);
        }
        $data->delete();
        Toastr::success('Opreation successfully','Success');
        return redirect()->route('admin.mission_list');
    }
    function mission_type(){
        try {
            $data = MisssionType::latest()->get();
            return view('backend.missions.missionType', compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }

    function mission_type_create(){
        try {
            return view('backend.missions.add_mission_type');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    function mission_type_store(Request $res){
        $this->validate($res,[
            "name" => "required",
            "type_text" => "required",
            "status" => "required"
        ]);
        try {
            $data = new MisssionType();
            $data->type_text = $res->type_text;
            $data->name = $res->name;
            $data->status = $res->status;
            $data->save();
            Toastr::success('Opearation success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    function mission_type_update(Request $res,$id){
        $this->validate($res,[
            "name" => "required",
            "type_text" => "required",
            "status" => "required"
        ]);
        try {
            $data = MisssionType::find($id);
            $data->type_text = $res->type_text;
            $data->name = $res->name;
            $data->status = $res->status;
            $data->save();
            Toastr::success('Opearation success');
            return redirect()->route('admin.mission_type_list');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    function mission_type_edit($id){
        try {
            $edit = MisssionType::find($id);
            return view('backend.missions.add_mission_type',compact('edit'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }

    }
    public function mission_type_destroy($id)
    {
        $data = MisssionType::find($id);
        $data->delete();
        Toastr::success('Opreation successfully','Success');
        return redirect()->back();
    }
}
