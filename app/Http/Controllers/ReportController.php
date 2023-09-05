<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
   

    function reportPage(){

        return view('pages.dashboard.report-page');
    }
}
