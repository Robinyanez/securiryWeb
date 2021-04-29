<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function novedad(Request $request){

        $user_id = Auth::user()->id;

        $users = DB::table('users as u')
                -> join('times as t','u.id','=','t.user_id')
                -> join('comments as c','c.time_id','=','t.id')
                ->select('u.id as user_id','u.name as name', 't.type as type', 't.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description', 'c.url_img as url_img')
                ->where('t.type', 'Novedad')
                ->where('u.id',$user_id)
                ->orderBy('t.date_time','desc')
                ->paginate(15);

        return response()->json($users);
    }

    public function consigna(Request $request){

        $user_id = Auth::user()->id;

        $users = DB::table('users as u')
                -> join('times as t','u.id','=','t.user_id')
                -> join('comments as c','c.time_id','=','t.id')
                ->select('u.id as user_id','u.name as name', 't.type as type', 't.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description', 'c.url_img as url_img')
                ->where('t.type', 'Consigna')
                ->where('u.id',$user_id)
                ->orderBy('t.date_time','desc')
                ->paginate(15);
                /* ->get(); */

        return response()->json($users);
    }

    /* tests */

    /* public function novedad2(Request $request){

        $users = DB::table('users as u')
                -> join('times as t','u.id','=','t.users_id')
                -> join('comments as c','c.times_id','=','t.id')
                ->select('u.id as user_id','u.name as name', 't.type as type', 't.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description', 'c.url_img as url_img')
                ->where('t.type', 'Consigna')
                ->paginate(5);

        return response()->json($users);
    } */
}
