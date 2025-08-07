<?php

namespace App\Http\Controllers\Backend\Subscriptions;

use App\CMS;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class SubscribersController extends Controller
{
  private $sendgrid_key;
  public function __construct()
  {
      $this->sendgrid_key = CMS::find(1)->sendgrid_secret;
  }

    public function index()
    {
       // retrieve all lists
        $list_curl = curl_init();

        curl_setopt_array($list_curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/lists?page_size=100",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $this->sendgrid_key"
            ),
        ));

        $lists = curl_exec($list_curl);
        $list_error = curl_error($list_curl);

        curl_close($list_curl);

        if ($list_error) {
            echo "cURL Error #:" . $list_error;
            $list_response = null;
        } else {
           $list_response = \GuzzleHttp\json_decode($lists)->result;
        }
        // retrieve  all transactional templates
        $template_curl = curl_init();

        curl_setopt_array($template_curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/templates?generations=dynamic&page_size=5",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $this->sendgrid_key"
            ),
        ));

        $template_response = curl_exec($template_curl);
        $template_err = curl_error($template_curl);

        curl_close($template_curl);

        if ($template_err) {
            echo "cURL Error #:" . $template_err;
            $template_response = null;
        } else {
            $template_response  = \GuzzleHttp\json_decode($template_response)->result;
        }
        // retrieve all contacts
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $this->sendgrid_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = \GuzzleHttp\json_decode($response)->result;
//            dd(\GuzzleHttp\json_decode($response)->result);
//           foreach (\GuzzleHttp\json_decode($response)->result as $item)
//           {
//               dd($item->email);
//               $counter = count($item);
//              for($i=0;$i<$counter;$i++)
//              {
//                  echo  $item[$i]->email.'<br>';
//              }
//           }
           return view('backend.subscriptions.index',compact('result','list_response','template_response'));
        }
    }
    public function send_email(Request $request)
    {
        $input                              = $request->all();
//        if ($input['list']!=null)
//        {
           if(Input::has('email'))
           {
               foreach ($input['email'] as $email)
               {
                   $curl                              = curl_init();

                   curl_setopt_array($curl, array(
                       CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
                       CURLOPT_RETURNTRANSFER => true,
                       CURLOPT_ENCODING => "",
                       CURLOPT_MAXREDIRS => 10,
                       CURLOPT_TIMEOUT => 30,
                       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                       CURLOPT_CUSTOMREQUEST => "POST",
                       CURLOPT_POSTFIELDS => "{\"personalizations\":[{\"to\":[{\"email\":\"$email\",\"subject\":\"Subject Override\"}],\"dynamic_template_data\":{\"verb\":\"\",\"adjective\":\"\",\"noun\":\"\",\"currentDayofWeek\":\"\"},\"subject\":\"Hello, World!\"}],\"from\":{\"email\":\"info@propersix.casino\",\"name\":\"John Doe\"},\"reply_to\":{\"email\":\"info@propersix.casino\",\"name\":\"John Doe\"},\"template_id\":\"$request->template\"}",
                       CURLOPT_HTTPHEADER => array(
                           "authorization: Bearer $this->sendgrid_key",
                           "content-type: application/json"
                       ),
                   ));

                   $response = curl_exec($curl);
                   $err = curl_error($curl);

                   curl_close($curl);

                   if ($err) {
                       echo "cURL Error #:" . $err;
                   }
               }
           }

//        }
//        else
//        {
//            $curl = curl_init();
//
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 30,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "GET",
//                CURLOPT_POSTFIELDS => "{}",
//                CURLOPT_HTTPHEADER => array(
//                    "authorization: Bearer $this->sendgrid_key"
//                ),
//            ));
//
//            $response = curl_exec($curl);
//            $err = curl_error($curl);
//
//            curl_close($curl);
//
//            if ($err) {
//                echo "cURL Error #:" . $err;
//            } else {
//                $result = \GuzzleHttp\json_decode($response)->result;
////            dd(\GuzzleHttp\json_decode($response)->result);
////           foreach (\GuzzleHttp\json_decode($response)->result as $item)
////           {
////               dd($item->email);
////               $counter = count($item);
////              for($i=0;$i<$counter;$i++)
////              {
////                  echo  $item[$i]->email.'<br>';
////              }
////           }
//                return view('backend.subscriptions.index',compact('result','list_response','template_response'));
//            }
//        }
           Toastr::success('email has been sent successfully');
            return redirect()->back()->with('mail_success_msg','Email has been sent successfully');
        }

    public function remove_email($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/contacts?ids=$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $this->sendgrid_key"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            Toastr::success('contact has been removed successfully');
            return redirect()->back()->with('mail_success_msg','Email has been removed successfully');
        }
    }
    public function all_contacts(Request $request)
    {
        $input                = $request->all();
        $curl = curl_init();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/marketing/lists/$request->list?contact_sample=true",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $this->sendgrid_key",
            ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = \GuzzleHttp\json_decode($response);
            return response()->json($result->contact_sample);
        }
    }
    public function statistic_report()
    {
        $today                         = Carbon::now();
        $start_date                    = $today->toDateString();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/stats?aggregated_by=day&start_date=$start_date",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $this->sendgrid_key",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//            foreach (\GuzzleHttp\json_decode($response) as $row)
//            {
//                foreach ($row->stats as $item)
//                {
//                    dd($item->metrics->requests);
//                }
//            }
            $result     = \GuzzleHttp\json_decode($response);
            return view('backend.subscriptions.statistics_report',compact('result'));
        }

    }
    public function statistic_filter(Request $request)
    {
        $input                          = $request->all();
        $start_date                     = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date                       = Carbon::parse($request->end_date)->format('Y-m-d');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sendgrid.com/v3/stats?aggregated_by=day&start_date=$start_date&end_date=$end_date",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $this->sendgrid_key",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//            foreach (\GuzzleHttp\json_decode($response) as $row)
//            {
//                foreach ($row->stats as $item)
//                {
//                    dd($item->metrics->requests);
//                }
//            }
            $result     = \GuzzleHttp\json_decode($response);
            return view('backend.subscriptions.statistics_report',compact('result'));
        }

    }
}
