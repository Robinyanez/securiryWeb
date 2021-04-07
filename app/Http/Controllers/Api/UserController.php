<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Time;
use App\Models\Comment;
use App\Models\Client;
use Auth;
use Carbon\Carbon;
use DB;

class UserController extends Controller
{
    public function user(Request $request){

        $users_id = Auth::user()->id;

        $user = User::with('client')->where('id',$users_id)->firstOrFail();

        return response()->json($user);
    }


    public function time(Request $request){

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
        $time->users_id = $user_id;
        /* $time->save(); */

        if ($time->save())
            return response()->json([
                'success' => true,
                'data' => $time->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Times and Coordinates not added'
            ], 500);
    }

    public function comment(Request $request){

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
        $time->users_id = $user_id;
        $time->save();

        $comment = new Comment;
        $comment->type =  $request->get('type');
        $comment->description = $request->get('description');

        $file = $request->file('url_img');
        $img = 'img_'.time().'_'.$file->getClientOriginalName();
        $route = public_path().'/img';
        $file->move($route , $img);

        $comment->url_img = '/img/'.$img;
        $comment->times_id = $time->id;

        if ($comment->save())
            return response()->json([
                'success' => true,
                'data' => $comment->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'comment not added'
            ], 500);

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
