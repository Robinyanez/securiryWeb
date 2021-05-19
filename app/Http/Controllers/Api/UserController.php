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
use App\Models\Image;
use App\Models\Zone;
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

    public function zone ($id){

        $zone = Zone::where('id',$id)->orderBy('name')->get();

        return response()->json($zone);
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

            /* $file = $request->file('url_img');
            $img = 'img_'.time().'_'.uniqid().'_'.$file->getClientOriginalName();
            $route = public_path().'/img';
            $file->move($route , $img);

            $comment->url_img = env('APP_URL').'/img/'.$img; */

            $comment->time_id = $time->id;
            $comment->save();

            $urlimagenes = [];

            $imagenes = $request->file('url_img');

            foreach ($imagenes as $file) {

                $img = 'img_'.time().'_'.uniqid().'_'.$file->getClientOriginalName();
                $route = public_path().'/img';
                $file->move($route , $img);
                $urlimagenes[]['url'] = env('APP_URL').'/img/'.$img;
            }

            $comment->image()->createMany($urlimagenes);

            DB::commit();

            return response()->json([
                'success' => true,
                'data' => $comment->toArray(),
                'img' => $imagenes
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

        $users = DB::table('users as u')
                ->join('times as t','u.id','=','t.user_id')
                ->join('comments as c','c.time_id','=','t.id')
                /* ->join('images as i','i.imageable_id','=','c.id') */
                ->select('u.id as id','u.name as name', 't.id as id_time','t.type as type','c.id as id_comment', 't.lat as lat','t.lng as lng',
                        't.date_time as date', 'c.description as description')
                ->where('t.type', 'Novedad')
                ->paginate(5);
                /* ->get(); */

        $json = json_decode(json_encode($users));

        /* dd($json->data); */
        /* return response()->json($json->data); */
        /* $dataUsers= $json->data; */

        /* return $json; */

        /* dd($dataUsers); */

        $prueba =[];

        /* foreach($json as $value){
            array_push($prueba, $value);
            $em = Image::select('url')->where('imageable_id',$value->id_comment)->get();
                foreach($em as $item){
                    $empresa['url'] = $item->url;
                }
        } */

        foreach($json->data as $value){

            /* $prueba = $key->name; */

            array_push($prueba, $value);
            /* $image = Image::select('url')->where('imageable_id',$value->id_comment)->get(); */

            /* foreach($image as $img){
                return $img->url;
            } */
        }

        dd($prueba,$json->data);

        /* $image = DB::table('images')->select('url')->where('imageable_id',$json->data[0]->id_comment)->get(); */

        /* $data = $json->data;

        $images = json_decode(json_encode($image));

        $temp = ['users' => $data, 'url_img' => $images];

        $temp['users']['img'] = $images; */

        /* array_push($data[0], $images); */

        /* dd(json_decode(json_encode($users)),$image,$json,$data,$temp); */
    }

}
