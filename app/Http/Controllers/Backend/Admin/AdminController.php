<?php

namespace App\Http\Controllers\Backend\Admin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;
use App\Balance;
use App\AddSpin;
use App\TokenCurrency;
use Auth;
class AdminController extends Controller
{
    /*function admin_token(){
        try {
            $data['loss']=Balance::where('amount_sign','i')->sum('balance');
            $data['profit']=Balance::where('amount_sign','l')->sum('balance');
            $data['token'] = Account::where(['user_id'=>1,'status'=>1])->first();
            return view('backend.admin.system_toke',compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }*/
    /*function Token_store(Request $request){
        $request->validate([
            'token' => 'required|integer|min:0',
        ]);
        try {
            Account::where('user_id',Auth::id())->update(['status'=>0]);
            $account= new Account();
            $account->user_id=Auth::id();
            $account->total=$request->token;
            $account->admin_total=$request->token;
            $account->status = 1;
            $account->save();
            Toastr::success('Tokens added Successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function Token_edit($id){
        try {
            $data['loss']=Balance::where('amount_sign','i')->sum('balance');
            $data['profit']=Balance::where('amount_sign','l')->sum('balance');
            $data['token'] = Account::where('user_id',1)->first();
            $edit = Account::find($id);
            return view('backend.admin.system_toke',compact('data','edit'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }*/
    function Token_update(Request $request){
        $request->validate([
            'token' => 'required|integer|min:0',
        ]);
        try {
            /*$account=Account::updateOrCreate(['user_id'=>Auth::user()->id]);
            $account->admin_total=$request->token;
            $account->save();*/
            /* $balan=Balance::updateOrCreate(['user_id'=>Auth::user()->id]);
            $balan->balance = $request->token;
            $balan->amount_sign = 'l';
            $balan->account_id = $account->id;
            $account->save();*/
            Toastr::success('Tokens added Successfully!');
            return redirect()->route('admin_token');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    // spin

    function admin_spin(){
        try {
            $data=AddSpin::latest()->get();
           return view('backend.admin.add_spin', compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function spin_store(Request $request){
        $request->validate([
            'title' => 'required|string',
            'bonus' => 'required|integer|min:0',
            'type' => "required|unique:add_spins,type",
        ]);
        try {
            $data=new AddSpin();
            $data->title = $request->title;
            $data->bonus = $request->bonus;
            $data->type = $request->type;
            $data->save();
            Toastr::success('Bonus spins added successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function spin_edit($id){

        try {
            $data=AddSpin::latest()->get();
            $edit = AddSpin::find($id);
            return view('backend.admin.add_spin', compact('edit','data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }

    function spin_update(Request $request, $id){
        $request->validate([
            'title' => 'required|string',
            'bonus' => 'required|integer|min:0',
            'type' => "required|unique:add_spins,type,". $id,
        ]);
        try {
            $data=AddSpin::find($id);
            $data->title = $request->title;
            $data->bonus = $request->bonus;
            $data->type = $request->type;
            $data->save();
            Toastr::success('Bonus spins updated Successfully!');
            return redirect()->route('admin_spin');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function spin_change($id){
        try {
            $data=AddSpin::find($id);
            if($data->status){
                $data->status = 0;
                $msg = 'Spin bonus disabled successfully !';
            }else{
                $data->status = 1;
                $msg = 'Spin bonus activated successfully !';
            }
            $data->save();
            Toastr::success($msg);
            return redirect()->route('admin_spin');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function currencyConversaton(){
        try {
            $data=TokenCurrency::latest()->get();
           return view('backend.admin.token_currency', compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }

    function currencyConversaton_store(Request $request){
        $request->validate([
            'play6_token' => 'required|integer|min:1',
            'doller' => "required|",
        ]);
        try {
            TokenCurrency::where('status',1)->update(['status'=>0]);
            $data= new TokenCurrency();
            $data->doller = $request->doller;
            $data->pley6_token = $request->play6_token;
            $data->status = 1;
            $data->save();
            Toastr::success('Tokens conversion rate added Successful!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function currencyConversaton_edit($id){
        try {
            $data=TokenCurrency::latest()->get();
            $edit = TokenCurrency::find($id);
            return view('backend.admin.token_currency', compact('edit','data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }

    function currencyConversaton_update(Request $request,$id){
        $request->validate([
            'play6_token' => 'required|integer|min:1',
            'doller' => "required|",
        ]);
        try {
            TokenCurrency::where('status',1)->update(['status'=>0]);
            $data= TokenCurrency::find($id);
            $data->doller = $request->doller;
            $data->pley6_token = $request->play6_token;
            $data->status = 1;
            $data->save();
            Toastr::success('Tokens conversion rate updated successfully !');
            return redirect()->route('currencyConversaton');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function system_settings(){
        try {
            return view('backend.admin.system_setting');
        }  catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
}
