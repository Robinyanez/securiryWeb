<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Time;
use App\Models\Apoyo;
use App\Models\Comment;
use App\Models\Client;
use App\Models\Puesto;
use Auth;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public function profile(Request $request){

        $user_id = Auth::user()->id;

        $user = User::with('client','cargo')->where('id',$user_id)->firstOrFail();

        return response()->json($user);
    }

    public function puesto(Request $request){

        $puesto = Puesto::orderBy('name')->get();

        return response()->json($puesto);
    }


    public function time(Request $request){

        try
        {
            DB::beginTransaction();

            $user_id = Auth::user()->id;

            $mydate = Carbon::now('America/Bogota');
            $mydate->toDateString();

            $mytime = Carbon::now('America/Bogota');
            $mytime->toTimeString();

            $mydatetime = Carbon::now('America/Bogota');
            $mydatetime->toDateTimeString();

            $time = new Time;
            $time->date = $mydate;
            $time->time = $mytime;
            $time->date_time = $mydatetime;
            $time->type = $request->get('type');
            $time->lat = $request->get('lat');
            $time->lng = $request->get('lng');
            $time->user_id = $user_id;
            $time->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $time->toArray()
            ]);

        }catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                    'success' => false,
                    'message' => 'Times and Coordinates not added'
                ], 500);
        }
    }

    public function comment(Request $request){

        try
        {
            DB::beginTransaction();

            $user_id = Auth::user()->id;

            $mydate = Carbon::now('America/Bogota');
            $mydate->toDateString();

            $mytime = Carbon::now('America/Bogota');
            $mytime->toTimeString();

            $mydatetime = Carbon::now('America/Bogota');
            $mydatetime->toDateTimeString();

            $time = new Time;
            $time->date = $mydate;
            $time->time = $mytime;
            $time->date_time = $mydatetime;
            $time->type = $request->get('type');
            $time->lat = $request->get('lat');
            $time->lng = $request->get('lng');
            $time->user_id = $user_id;
            $time->save();

            $comment = new Comment;
            $comment->type =  $request->get('type');
            $comment->description = $request->get('description');

            $file = $request->file('url_img');
            $img = 'img_'.time().'_'.uniqid().'_'.$file->getClientOriginalName();
            $route = public_path().'/img';
            $file->move($route , $img);

            $comment->url_img = env('APP_URL').'/img/'.$img;
            $comment->time_id = $time->id;
            $comment->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $comment->toArray()
            ]);

        }catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'comment not added'
            ], 500);
        }
    }

    public function apoyo(Request $request){

        try
        {
            DB::beginTransaction();

            $user_id = Auth::user()->id;

            $mydate = Carbon::now('America/Bogota');
            $mydate->toDateString();

            $mytime = Carbon::now('America/Bogota');
            $mytime->toTimeString();

            $mydatetime = Carbon::now('America/Bogota');
            $mydatetime->toDateTimeString();

            $time = new Time;
            $time->date = $mydate;
            $time->time = $mytime;
            $time->date_time = $mydatetime;
            $time->type = $request->get('type');
            $time->lat = $request->get('lat');
            $time->lng = $request->get('lng');
            $time->user_id = $user_id;
            $time->save();

            $apoyo = new Apoyo;
            $apoyo->actividad = $request->get('actividad');
            $apoyo->time_id = $time->id;
            $apoyo->puesto_id = $request->get('puesto_id');
            $apoyo->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $apoyo->toArray()
            ]);

        }catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'apoyo not added'
            ], 500);
        }
    }

    /* tests */

    public function user2(Request $request){

        /* $users_id = Auth::user()->id; */

        /* $user = DB::table('users as u')
                -> join('clients as c','u.id','=','c.users_id')
                ->select('u.name as name', 'u.role as role', 'c.name as client')
                ->where('u.id','=',$users_id)
                ->get(); */

        /* $user = User::with('clients')->get(); */
        $user = User::with('times')->where('role','Vigilante')->get();

        /* return response()->json($request->user()); */
        return response($user);
    }

}
