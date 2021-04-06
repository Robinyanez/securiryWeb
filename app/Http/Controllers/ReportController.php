<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ReportController extends Controller
{
    public function indexVigilat(){
        return view('admin.report.vigilant');
    }

    public function indexClient(){
        return view('admin.report.client');
    }

    public function indexSupervisor(){
        return view('admin.report.supervisor');
    }
}
