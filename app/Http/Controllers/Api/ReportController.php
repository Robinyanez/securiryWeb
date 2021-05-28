<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Image;
use Auth;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function novedad(Request $request){

        $user_id = Auth::user()->id;

        $users = DB::table('users as u')
                ->join('clients as cl','cl.id','=','u.client_id')
                ->join('times as t','u.id','=','t.user_id')
                ->join('comments as c','c.time_id','=','t.id')
                ->select('t.id as id','u.name as name','cl.lat as latcli','cl.lng as lngcli','t.type as type','c.id as id_comment','t.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description')
                ->where('t.type', 'Novedad')
                ->where('u.id',$user_id)
                ->orderBy('t.date_time','desc')
                ->paginate(10);

        return response()->json($users);
    }

    public function novedadDetail(Request $request, $id){

        $user_id = Auth::user()->id;

        $users = DB::table('users as u')
                ->join('clients as cl','cl.id','=','u.client_id')
                ->join('times as t','u.id','=','t.user_id')
                ->join('comments as c','c.time_id','=','t.id')
                ->select('t.id as id','u.name as name','cl.lat as latcli','cl.lng as lngcli','t.type as type','c.id as id_comment','t.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description')
                ->where('t.type', 'Novedad')
                ->where('t.id',$id)
                ->where('u.id',$user_id)
                ->get();

        return response()->json($users);
    }

    public function consigna(Request $request){

        $user_id = Auth::user()->id;

        $users = DB::table('users as u')
                ->join('clients as cl','cl.id','=','u.client_id')
                ->join('times as t','u.id','=','t.user_id')
                ->join('comments as c','c.time_id','=','t.id')
                ->select('t.id as id','u.name as name','cl.lat as latcli','cl.lng as lngcli','t.type as type','c.id as id_comment','t.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description')
                ->where('t.type', 'Consigna')
                ->where('u.id',$user_id)
                ->orderBy('t.date_time','desc')
                ->paginate(10);

        return response()->json($users);
    }

    public function consignaDetail(Request $request, $id){

        $user_id = Auth::user()->id;

        $users = DB::table('users as u')
                ->join('clients as cl','cl.id','=','u.client_id')
                ->join('times as t','u.id','=','t.user_id')
                ->join('comments as c','c.time_id','=','t.id')
                ->select('t.id as id','u.name as name','cl.lat as latcli','cl.lng as lngcli','t.type as type','c.id as id_comment','t.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description')
                ->where('t.type', 'Consigna')
                ->where('t.id',$id)
                ->where('u.id',$user_id)
                ->get();

        return response()->json($users);
    }

    public function images($id){

        $images = Image::select('url','imageable_id')->where('imageable_id',$id)->get();

        return response()->json($images);
    }

    public function imagesAll(){

        $images = Image::select('url','imageable_id')->get();

        return response()->json($images);
    }

    public function apoyo(Request $request){

        $user_id = Auth::user()->id;

        $users = DB::table('users as u')
                ->join('times as t','u.id','=','t.user_id')
                ->join('apoyos as a','t.id','=','a.time_id')
                ->join('puestos as p','p.id','=','a.puesto_id')
                ->select('t.id as id','u.name as name','a.actividad as type','p.name as puesto','t.lat as lat','t.lng as lng','t.date_time as date')
                ->where('u.id',$user_id)
                ->orderBy('t.date_time','desc')
                ->paginate(5);

        return response()->json($users);
    }

}
