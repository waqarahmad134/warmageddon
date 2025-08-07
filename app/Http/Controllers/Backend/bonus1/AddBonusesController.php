<?php

namespace App\Http\Controllers\Backend\bonus1;

use App\Bonus;
use DB;
use Session;
use App\User;
use App\AddGame;
use App\AddBonus;
use App\BonusCode;
use App\LeaveNote;
use App\Deposit;
use App\Notification;
use App\TokenCurrency;
use App\Http\Requests;
use App\PropersixBonus;
use App\RegistrationBonus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class AddBonusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */



    public function add_user_token(Request $request , $id){
      $tok = TokenCurrency::where(['status'=>1,'doller'=>1])->first();
      $userWallet=\App\ProsixUserWallet::updateOrCreate(['user_id'=>$id]);
      $deposit = new Deposit();
      $user = User::find($id);
      $deposit->user_id = $id;
      $deposit->type = $id;
      $deposit->charge_id = 'ch_'. str_random(20);
      $deposit->amount = $request->get('add_token');
      $deposit->from = 'Casino';
      $deposit->to = $user->user_name;
      $deposit->save();
      $userWallet->usd=$userWallet->usd+($request->add_token/$tok->pley6_token);
      $userWallet->token= $userWallet->token + $request->add_token ;
      $userWallet->save();
      $tran_Type= new \App\TransactionType();
      $tran_Type->type='add_token';
      $tran_Type->created_by=Auth::id();
      $tran_Type->save();

      $transaction =new \App\ProsixTransaction();
      $transaction->user_id = $id;
      $transaction->amount = $request->add_token;
      $transaction->currency = 'pley6_token';
      $transaction->from = 'casino';
      $transaction->type =  $tran_Type->id;
      $transaction->to = $user->user_name;
      $transaction->created_by=Auth::id();
      $transaction->save();
      $data = new LeaveNote();
      $data->user_id = $id;
      $data->body = 'You received bonus of '.$request->add_token.' tokens from Casino';
      $data->status = 0;
      $data->save();
      Toastr::success('Tokens added successfully','success');
      return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\bonus.add-bonuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'bonus_name' => 'required|string',
            'bonus_code' => 'required',
            'bonus_amount' => 'required|string',
            'withdrawal_limit' => 'required',
            'uses_limit' => 'required',
            'deposit_bonus' => 'required',
            'bonus_limit_amount' => 'sometimes|nullable',
            'expire_date' => 'sometimes|nullable|date',
            'status' => 'sometimes|nullable|string',
            'typew' => 'sometimes|nullable|string',
            'base_image' => 'sometimes|nullable',
        ]);
        $add_bonuses=new AddBonus();
        $add_bonuses->bonus_name=$request->bonus_name;
        $add_bonuses->b_code=$request->bonus_code;
        $add_bonuses->b_amount=$request->bonus_amount;
        $add_bonuses->w_limit=$request->withdrawal_limit;
        $add_bonuses->u_limit=$request->uses_limit;
        $add_bonuses->d_limit=$request->deposit_bonus;
        $add_bonuses->limit_amount=$request->bonus_limit_amount;
        $add_bonuses->expire_date=$request->expire_date;
        $add_bonuses->type=$request->typew;
        $add_bonuses->status=$request->status;
        $image=$request->base_image;
            if($image){
                $imageName=time().'.'.$image->getClientOriginalName();
                $image->move('bonus/', $imageName);
                $add_bonuses->image=$imageName;
            }
        $add_bonuses->save();
        Toastr::success('Bonus  added successfully','Success');
        return redirect()->back();
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $addbonus = AddBonus::findOrFail($id);

        return view('backend\bonus.add-bonuses.show', compact('addbonus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $addbonus = AddBonus::findOrFail($id);

        return view('backend\bonus.add-bonuses.edit', compact('addbonus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $addbonus = AddBonus::findOrFail($id);
        $addbonus->update($requestData);

        return redirect('add-bonuses')->with('flash_message', 'AddBonus updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        AddBonus::destroy($id);

        return redirect('add-bonuses')->with('flash_message', 'AddBonus deleted!');
    }


    function RegistrationBonus(){
        try {
            $data=RegistrationBonus::latest()->get();
           return view('backend.bonus.user-sign.registration_bonus', compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function RegistrationBonusStore(Request $request){
        $request->validate([
            'title' => 'required|string',
            'bonus' => 'required',
            'type' => "required|unique:registration_bonuses,type",
        ]);
        try {
            $data=new RegistrationBonus();
            $data->title = $request->title;
            $data->bonus = $request->bonus;
            $data->type = $request->type;
            $data->save();
            Toastr::success('User bonus added successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function RegistrationBonusEdit($id){

        try {
            $data=RegistrationBonus::latest()->get();
            $edit = RegistrationBonus::find($id);
            return view('backend.bonus.user-sign.registration_bonus', compact('edit','data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }

    function RegistrationBonusUpdate(Request $request, $id){
        $request->validate([
            'title' => 'required|string',
            'bonus' => 'required',
            'type' => "required|unique:registration_bonuses,type,". $id,
        ]);
        try {
            $data=RegistrationBonus::find($id);
            $data->title = $request->title;
            $data->bonus = $request->bonus;
            $data->type = $request->type;
            $data->save();
            Toastr::success('User bonus updated successfully !');
            return redirect()->route('RegistrationBonus');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    function RegistrationBonusStatus($id){
        try {
            $data=RegistrationBonus::find($id);
            if($data->status){
                $data->status = 0;
                $msg = 'Bonus disabled successfully !';
            }else{
                $data->status = 1;
                $msg = 'Bonus activated successfully !';
            }
            $data->save();
            Toastr::success($msg);
            return redirect()->route('RegistrationBonus');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    // LeaveNote


    function UsaerLeaveMessageindex(Request $request,$id){
      $commentsList = LeaveNote::where('user_id' , $id)->orderBy('created_at','desc')->get();
      $user = User::find($id);
      return view('backend.customer.customer-comments', compact('commentsList' , 'user'));
    }
    function UsaerLeaveMessage(Request $request,$id){
        $request->validate([
            'body' => 'required|',
        ]);
        DB::beginTransaction();
        try {
            $data = new LeaveNote();
            $data->user_id = $id;
            $data->body = $request->body;
            $data->save();

            DB::commit();
            Toastr::success('Message Sent Successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }

}
