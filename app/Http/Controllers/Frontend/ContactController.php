<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\Contact\SendContact;
use App\Http\Requests\Frontend\Contact\SendContactRequest;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    // $kontac = new ContactController();
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * @param SendContactRequest $request
     *
     * @return mixed
     */
    public function send(Request $request)
    {
        $name   = $request->input('name');
        $email  = $request->input('email');
        $text   = $request->input('message');

        $all_val = array(
            "username" => "$name",
            "user_email" => "$email",
            "message" => "$text",
            "source" => "propersix-casino"
        );
       try {
           $data = json_encode($all_val);
           $api_url = "https://kyc.propersix.com/api/memebr/save";
           $send_method = "POST";
           $apiCall = $this->callAPI($send_method, $api_url, $data);
           $jsonData = json_decode($apiCall, true);

           if ($jsonData['msg'] == "success") {
               return redirect()->back()->with('success', "Thanks For sending us a message. We'll get back to you ASAP");
           } else {
               return redirect()->back()->with('error', "Error");
           }
       } catch (\Exception $e) {
           Toastr::error('Something went wrong ! please try again');
           return redirect()->back();
       }
    }

    public function callAPI($method, $url, $data){
        $curl = curl_init();
      try {
          switch ($method) {
              case "POST":
                  curl_setopt($curl, CURLOPT_POST, 1);
                  if ($data)
                      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  break;
              case "PUT":
                  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                  if ($data)
                      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  break;
              default:
                  if ($data)
                      $url = sprintf("%s?%s", $url, http_build_query($data));
          }

          // OPTIONS:
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
              'Authorization: YWRtaW46YWRtaW4hMTIz',
              'Content-Type: application/json',
          ));
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

          // EXECUTE:
          $result = curl_exec($curl);
          if (!$result) {
              die("Connection Failure");
          }
          curl_close($curl);
          return $result;
      }catch (\Exception $e) {
          Toastr::error('Something went wrong ! please try again');
          return redirect()->back();
      }
    }
}
