<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Date;

class ReportController extends Controller
{
   

    function reportPage(){

        return view('pages.dashboard.report-page');
    }

    function saleReport(Request $request){

        $userId=$request->header('id');

        $formDate=Date("Y-m-d",strtotime($request->formDate));
        $toDate=Date("Y-m-d",strtotime($request->toDate));
        $total=Invoice::where("user_id",$userId)->whereDate('created_at', '>=', $formDate)->whereDate('created_at', '<=', $toDate)->sum('total');
        $vat=Invoice::where("user_id",$userId)->whereDate('created_at', '>=', $formDate)->whereDate('created_at', '<=', $toDate)->sum('vat');
        $discount=Invoice::where("user_id",$userId)->whereDate('created_at', '>=', $formDate)->whereDate('created_at', '<=', $toDate)->sum('discount');
        $payable=Invoice::where("user_id",$userId)->whereDate('created_at', '>=', $formDate)->whereDate('created_at', '<=', $toDate)->sum('payable');
        $list=Invoice::where('user_id',$userId)->whereDate('created_at', '>=', $formDate)->whereDate('created_at', '<=', $toDate)->with('customer')->get();

        $data= [
            'total'=>$total,
            'vat'=>$vat,
            'discount'=>$discount,
            'payable'=>$payable,
            'FormDate'=>$formDate,
            'ToDate'=>$toDate,
            'list'=>$list
        ];

        $pdf=Pdf::loadview('report.SalesReport',$data);
        return $pdf->download('invoice.pdf');

       
    }
}
