<?php

namespace App\Http\Controllers\backend\Tickets;

use App\TicketContents;
use App\Tickets;
use App\TicketStatus;
use App\User;
use Auth;
use Mail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index()
    {
        $tickets                               =    Tickets::all();
        return view('backend.tickets.index',compact('tickets'));
    }
    public function show($id)
    {
        $ticket                         = Tickets::where('id',$id)
                                                    ->with('contents','files','Ticketstatus','user')
                                                    ->first();
        $user_itckets                  = Tickets::where('user_id',$ticket->user_id)
                                                ->with('contents','files','Ticketstatus','user')
                                                ->get();
        return view('backend.tickets.show',compact('ticket','user_itckets'));
    }
    public function fetch_contents($id)
    {
        $ticket                               = Tickets::where('id',$id)
                                                ->with('contents','files','Ticketstatus','user')
                                                ->first();
        $content                             = TicketContents::where('ticket_number',$ticket->ticket_number)
                                                              ->with('user','userProfile')
                                                               ->get();
        foreach ($content as $row)
        {
            $c                   = TicketContents::where('id',$row->id)->first();
            $c->read_status      = 1;
            $c->save();
        }
        return response()->json([
            'ticket'    => $ticket,
            'content'   => $content
        ]);
    }
    public function update_status(Request $request)
    {
        $input                         = $request->all();
        $ticket                        = Tickets::where('id',$input['ticket_id'])
                                                 ->with('contents','files','Ticketstatus','user')
                                                 ->first();
        $user                            = User::where('id',$ticket->user_id)->first();
        if($input['status']>$ticket->Ticketstatus->last()->status && $input['status']>$ticket->ticket_status)
        {
            $ticket->ticket_status         = $input['status'];
            $ticket->save();
            $ticket_status                 = new TicketStatus();
            $ticket_status->ticket_number  = $ticket->ticket_number;
            $ticket_status->status         = $input['status'];
            $ticket_status->save();
            Mail::send('mail.ticket_status', [
                'username'       => $user->user_name,
                'ticket_number'  => $ticket->ticket_number,
            ], function($message) use($user){
                $message->subject('Ticket Status Updated');
                $message->to($user->email);
            });
            Toastr::success('Ticket status updated successfully');
        }
        else{
            Toastr::error('Ticket status should be greater than its current status','error');
        }
        $ticket                         = Tickets::where('id',$input['ticket_id'])
                                                    ->with('contents','files','Ticketstatus','user')
                                                    ->first();
        $user_itckets                  = Tickets::where('user_id',$ticket->user_id)
                                                    ->with('contents','files','Ticketstatus','user')
                                                    ->get();
        return view('backend.tickets.show',compact('ticket','user_itckets'));

    }
    public function send_message(Request $request)
    {
        $input                           = $request->all();
        $ticket                          = Tickets::where('ticket_number',$input['ticket_number'])->first();
        $user                            = User::where('id',$ticket->user_id)->first();
        $ticket_content                  = new TicketContents();
        $ticket_content->ticket_number   = $input['ticket_number'];
        $ticket_content->message         = $input['content'];
        $ticket_content->user_id         = Auth::user()->id;
        $ticket_content->status          = 0;
        $ticket_content->save();
        Mail::send('mail.ticket_message', [
            'username'       => $user->user_name,
            'ticket_number'  => $ticket->ticket_number,
        ], function($message) use($user){
            $message->subject('New message against ticket');
            $message->to($user->email);
        });
        //$result                          = TicketContents::latest()->first();
        return response()->json($ticket_content);
    }
}
