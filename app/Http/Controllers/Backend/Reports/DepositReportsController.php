<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use League\Csv\Writer;

class DepositReportsController extends Controller
{
    //

    public function index()
    {
        $deposits = Deposit::SELECT(['from','to','type','amount'])->take(10)->get();
        return view('backend.reports.deposit-reports',compact('deposits'));
    }

    function generate_report(){
        $deposits = Deposit::SELECT(['from AS Deposit From','to as Deposit To','type','amount'])->take(10)->get()->toArray();;

        // Create CSV file
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(array_keys($deposits[0]));
        $csv->insertAll($deposits);

        // Set headers for download
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="deposite-'.time().'.csv"',
        ];

        $csvContent = $csv->getContent();

        // Return response with CSV content and headers
        return response()->stream(
            function () use ($csvContent) {
                echo $csvContent;
            },
            Response::HTTP_OK,
            $headers
        );
    }
}
