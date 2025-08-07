<?php

namespace App\Http\Controllers\Frontend;

use App\ProsixWallet;
use App\TicketContents;
use App\Tickets;
use App\TicketStatus;
use App\User;
use Session;
use Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
class TicketController extends Controller
{
    function generateTicketNumber() {
        $number = str_random(10); // better than rand()

        // call the same function if the barcode exists already
        if ($this->TicketNumberExists($number)) {
            return $this->generateTicketNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }
    function TicketNumberExists($number) {
        return Tickets::whereTicket_number($number)->exists();
    }
    public function send_ticket(Request $request)
    {
//        if($request->file('files')) {
//            $validator              = Validator::make($request->all(), [
//                'files'                  =>'mimes:jpeg,png,jpg,gif,svg,pdf,txt',
//            ]);
//
//            if ($validator->fails()) {
//                Toastr::error("Only pdf and images files allow to upload");
//                return redirect()->back();
//            }
//        }
        $input                   = $request->all();
        $validator = Validator::make(
            $input, [
            'files.*' => 'required|mimes:jpg,jpeg,png,bmp,svg,gif,pdf,doc,docx,txt|max:10240'
        ],[
                'files.*.mimes' => 'Only these formats are accepted: jpeg, png, svg, gif, bmp.',
                'files.*.max'  => "Files may not be greater than 10MB"

            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->with('inbox_tab','send_ticket');
        }

        $check                   = DB::table('ticket')->insert([
           'ticket_number'       =>  $this->generateTicketNumber(),
            'user_id'            => Auth::user()->id,
            'ticket_title'       => strip_tags($input['subject']),
            'ticket_status'             => 0,
        ]);
//        $this->update_pro_session(Auth::user()->id,$request);
        if ($check)
        {
           $ticket         = DB::table('ticket')->latest()->first();
            DB::table('ticket_content')->insert([
                'ticket_number'        =>  $ticket->ticket_number,
                'user_id'              => $ticket->user_id,
                'message'              => strip_tags($input['summary']),
                'status'        => 0,
            ]);
            if($request->file('files')) {
                $files = $request->file('files');

                foreach ($files as $file) {

                    $name = (Auth::user()->user_name!=null?Auth::user()->user_name:Auth::user()->id).'_'.time() . '.' . $file->getClientOriginalName();
                    $destinationPath = base_path('/backend/tickets/');
                    $destination = $file->move($destinationPath, $name);
                    DB::table('ticket_files')->insert([
                        'ticket_number' => $ticket->ticket_number,
                        'file'    => $name,
                        'status'  => 0
                    ]);
                }

            }
            DB::table('ticket_status')->insert([
                'ticket_number'  => $ticket->ticket_number,
                'status'         => 0
            ]);
         Toastr::success('The ticket has been successfully submitted.' ,'Success');
        }
      else{
          Toastr::error('Something went wrong. Please try again. ','Error');

      }
        return redirect()->back()->with('inbox_tab','send_ticket');
    }
    public function show($id)
    {
        $ticket                         = Tickets::where('id',$id)
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
        return view('frontend.tickets.show',compact('ticket'));
    }
    public function update(Request $request)
    {
        $input                           = $request->all();
        $ticket_content                  = new TicketContents();
        $ticket_content->ticket_number   = $input['ticket_number'];
        $ticket_content->message         = $input['content'];
        $ticket_content->user_id         = Auth::user()->id;
        $ticket_content->read_status     = 0;
        $ticket_content->status          = 0;
        $ticket_content->save();
//        $status                          = new TicketStatus();
//        $status->ticket_number           = $input['ticket_number'];
//        $status->status                  = 0;
//        $status->save();
        $result                          = TicketContents::where('id',$ticket_content->id)
                                               ->with('user')
                                               ->first();
        return response()->json($result);
    }
    function update_pro_session($userId,$request)
    {

        $data                   = ProsixWallet::where('user_id',$userId)
            ->latest()
            ->first();
        $request->session()->put('proSix_walletData',$data);
    }
}
