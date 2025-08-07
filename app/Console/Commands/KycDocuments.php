<?php

namespace App\Console\Commands;

use App\GeneralSetting;
use App\User;
use App\UserDocuments;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Input;

class KycDocuments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kyc:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $documents                = \App\KycDocuments::where('status',0)->get();
        foreach ($documents as $row)
        {
            if ($row->requesID!=null)
            {
                $client           = new Client();
                $res = $client->post('https://kyc.propersix.com/autix/auapi/bos/api.php',
                    [
                        'multipart' => [
                            [
                                'name' => 'docType',
                                'contents' => 'followup'
                            ],
                            [
                                'name' => 'requestId',
                                'contents' => $row->requesID
                            ],

                        ]]);
                $status            = \App\KycDocuments::where('id',$row->id)->first();
                $status->response  = \Opis\Closure\serialize(json_decode($res->getBody()));
                $status->status    =  1;
                $status->save();

                // automatic verification
                     $check           = GeneralSetting::findOrFail(1);
                     if ($check->kyc_action==1)
                     {
                         if((json_decode($res->getBody())->requestResponse->response==null || json_decode($res->getBody())->requestResponse->response->CompletionStatus=="RequestRejected") || (json_decode($res->getBody())->requestResponse->response->ProcessingResult==null || json_decode($res->getBody())->requestResponse->response->CompletionStatus!="Ok"))
                         {
                             $data = UserDocuments::find($row->doc_id);
                             $user = User::find($data->user_id);
                             $user->document_approved = 0;
                             $user->save();
                             $data->identity_status = 3;
                             $data->bank_status     = 3;
                             if ($data->back_side!=null)
                             {
                                 $data->back_status     = 3;
                             }
                             $data->status = 3;
                             $data->note  = "Documents Rejected by Kyc";
                             $data->save();
                         }
                         else
                         {
                             $data = UserDocuments::find($row->doc_id);
                             $user = User::find($data->user_id);
                             $user->document_approved = 1;
                             $user->save();
                             $data->identity_status = 2;
                             $data->bank_status     = 2;
                             if ($data->back_side!=null)
                             {
                                 $data->back_status     = 2;
                             }
                             $data->status          = 2;
                             $data->note  = "Documents Approved by Kyc";
                             $data->save();
                         }
                     }

            }
        }
        \Log::info("KYC Cron is working fine!");


        $this->info('kyc:Cron command Run successfully!');
    }
}
