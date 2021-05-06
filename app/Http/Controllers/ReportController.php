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

    public function consigna(){
        return view('admin.report.r_consigna');
    }

    public function timeSupervisor(){
        return view('admin.report.rh_supervisor');
    }

    public function asalto(){
        return view('admin.report.r_asalto');
    }

    public function sospechoso(){
        return view('admin.report.r_sospechoso');
    }

    public function herido(){
        return view('admin.report.r_herido');
    }

    public function incendio(){
        return view('admin.report.r_incendio');
    }

    public function manifestacion(){
        return view('admin.report.r_manifestacion');
    }

    public function ausencia(){
        return view('admin.report.r_ausencia');
    }

    public function recomendacion(){
        return view('admin.report.r_recomendacion');
    }

    public function reclamo(){
        return view('admin.report.r_reclamo');
    }

    public function denuncia(){
        return view('admin.report.r_denuncia');
    }

    public function apoyo(){
        return view('admin.report.rh_apoyo');
    }

    public function hombreVivo(){
        return view('admin.report.rh_hombrevivo');
    }

}
