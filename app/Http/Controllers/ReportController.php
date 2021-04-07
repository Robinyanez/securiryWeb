<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ReportController extends Controller
{
    public function timeVigilat(){
        return view('admin.report.rh_vigilant');
    }

    public function novedad(){
        return view('admin.report.r_novedad');
    }

    public function consgina(){
        return view('admin.report.r_consigna');
    }

    public function timeSupervisor(){
        return view('admin.report.rh_supervisor');
    }
}
