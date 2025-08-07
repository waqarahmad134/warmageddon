<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Controllers\backend\affiliate\AffiliateAppController;
use App\User;
use App\BuyToken;
use App\ListUser;
use App\Http\Requests;
use App\UserDocuments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class ListUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user=User::latest()->get();
       // dd($user);
        return view('backend.user-management.list-users.user-list',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-management.list-users.create');
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

        $requestData = $request->all();

        ListUser::create($requestData);

        return redirect('list-users')->with('flash_message', 'ListUser added!');
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
        $userprofile = User::findOrFail($id);
        $loggedinhistoryuser = $userprofile->Loginhistory;
        $userDeposit = $userprofile->deposit;
        return view('backend.user-management.list-users.show_user', compact('userprofile' , 'loggedinhistoryuser'));
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
        $listuser = ListUser::findOrFail($id);

        return view('backend.user-management.list-users.edit', compact('listuser'));
    }

    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $listuser = ListUser::findOrFail($id);
        $listuser->update($requestData);

        return redirect('list-users')->with('flash_message', 'ListUser updated!');
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
        ListUser::destroy($id);

        return redirect('list-users')->with('flash_message', 'ListUser deleted!');
    }
    public function status_change($id){
        $user = User::find($id);
        if($user->status){
            app(AffiliateAppController::class)->mark_player_disable($user,"backend");
            $user->status = 0;
            $msg = 'User disabled successfully !';
        }else{
            app(AffiliateAppController::class)->unmark_player_disable($user,"backend");
            $user->status = 1;
            $msg = 'User activated successfully !';
        }
        $user->save();
        Toastr::success($msg);
        return redirect()->back();
    }
    public function delete($id){
        User::destroy($id);
        Toastr::success('User deleted successfully');
        return redirect()->back();
    }

    public function UserDocument(){
        try {
            $data = UserDocuments::latest()->get();
            return view('backend.user-management.user-document.index',compact('data'));
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    public function UserDocumentDownload($id, $type = false){
        try {

            $data = UserDocuments::find($id);
            if($_GET['type'] == 'identity'){
                $file = $data->identity;
            }else{
                $file = $data->bank_statement;
            }
            $name = basename($file);
            return response()->download($file, $name);

        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    public function UserDocumentApprove($id,Request $request){
        try {
            $data = UserDocuments::find($id);
            $user = User::find($data->user_id);
            $user->document_approved = 1;
            $user->save();
            $data->identity_status  = Input::has('identity_status')?$request->identity_status:$data->identity_status;
            $data->bank_status      = Input::has('bank_status')?$request->bank_status:$data->bank_status;
            $data->status = 2;
            $data->save();
            Toastr::success('User document approved successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    public function UserDocumentReject($id,Request $request){
        try {
            $data = UserDocuments::find($id);
            $user = User::find($data->user_id);
            $user->document_approved = 0;
            $user->save();
            $data->identity_status  = Input::has('identity_status')?$request->identity_status:$data->identity_status;
            $data->bank_status      = Input::has('bank_status')?$request->bank_status:$data->bank_status;
            $data->status = 3;
            $data->note  = $request->notes;
            $data->save();
            $notification=new \App\Notification;
            $notification->user_id=$data->user->id;
            $notification->message=$request->notes;
            $notification->save();
            Toastr::success('User document Rejected!');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again. ','Error');
            return redirect()->back();
        }
    }
    public function UserDocumentView($id){
        try {
                $value = UserDocuments::where('user_documents.id',$id)
                    ->leftJoin('kyc_documents', 'kyc_documents.doc_id', '=', 'user_documents.id')
                ->leftJoin('users', 'users.id', '=', 'user_documents.user_id')
                ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'user_documents.user_id')
                ->leftJoin('countries', 'countries.id', '=', 'user_profiles.country')
                ->select('user_documents.*', 'kyc_documents.*','user_documents.status as documentstatus','user_documents.id as documentid','user_documents.created_at as documentCreatdAt', 'countries.name as countryname', 'users.*','user_profiles.state','user_profiles.zipcode','user_profiles.first_name as firstname','user_profiles.last_name as lastname')->first();
                return view('backend.user-management.user-document.show',compact('value'));


        } catch (\Exception $e) {
            Toastr::error('Something went wrong. Please try again.','Error');
            return redirect()->back();
        }
    }


}
