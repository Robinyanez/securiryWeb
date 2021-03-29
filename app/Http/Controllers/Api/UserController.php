<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Time;
use App\Models\Comment;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function user(Request $request){

        return response()->json($request->user());
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
                'message' => 'Post not added'
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
        $comment->url_img = $request->get('url_img');
        $comment->times_id = $time->id;

        if ($comment->save())
            return response()->json([
                'success' => true,
                'data' => $comment->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);

    }
}
