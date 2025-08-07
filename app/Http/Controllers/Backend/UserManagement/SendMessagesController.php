<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\jobs\ProcessJobMail;
use App\SendMessage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
class SendMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.user-management.send-messages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-management.send-messages.create');
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
        $user=\App\User::all();
        foreach ($user as $key => $value) {
            if ($value->roles()->pluck('name')->implode(' ') == 'User') {
                $message=new SendMessage;
                $message->sender=Auth::user()->id;
                $message->receiver=$value->id;
                $message->message=$request->message_send;
                $message->status=0;
                $message->save();               
                $emailJob = (new ProcessJobMail($value))->delay(Carbon::now()->addSeconds(3));
                dispatch($emailJob);
                
            }
        }
        Toastr::success('Admin ','Mail send !');
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
        $sendmessage = SendMessage::findOrFail($id);

        return view('backend.user-management.send-messages.show', compact('sendmessage'));
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
        $sendmessage = SendMessage::findOrFail($id);

        return view('backend.user-management.send-messages.edit', compact('sendmessage'));
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
        
        $sendmessage = SendMessage::findOrFail($id);
        $sendmessage->update($requestData);

        return redirect('send-messages')->with('flash_message', 'SendMessage updated!');
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
        SendMessage::destroy($id);

        return redirect('send-messages')->with('flash_message', 'SendMessage deleted!');
    }
}
