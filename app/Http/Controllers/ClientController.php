<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Zone;
use App\Models\Client;
use App\Models\User;
/* use Auth;
use Carbon\Carbon; */

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $clients = Client::orderBy('name')->get();
        return view('admin.client.index', compact('clients')); */

        return view('admin.client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('name')->get();
        $zones = Zone::all();
        $users = User::where('role','Vigilante')->orWhere('role','Supervisor')->orderBy('name')->get();
        return view('admin.client.create', compact('countries','zones','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cedula' => 'required|unique:clients,cedula',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|unique:clients,email|email',
            'users_id' => 'required',
            'countries_id' => 'required',
            'zones_id' => 'required',
        ]);

        try{

        $clients = new Client;
        $clients->name = $request->get('name');
        $clients->cedula = $request->get('cedula');
        $clients->phone = $request->get('phone');
        $clients->email = $request->get('email');
        $clients->users_id = $request->get('users_id');
        $clients->countries_id = $request->get('countries_id');
        $clients->zones_id = $request->get('zones_id');
        $clients->save();
        /* dd($clients); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.client.index');

        }catch(\Exception $e){

            session()->flash('error', 'Hubo un error al completar el formulario');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $zones = Zone::all();
        $users = User::where('role','Vigilante')->orWhere('role','Supervisor')->orderBy('name')->get();
        return view('admin.client.edit', compact('clients','countries','zones','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'cedula' => 'required|unique:clients,cedula,'.$id,
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email|unique:clients,email,'.$id,
            'users_id' => 'required',
            'countries_id' => 'required',
            'zones_id' => 'required',
        ]);

        try{

        $clients = Client::findOrFail($id);
        $clients->name = $request->get('name');
        $clients->cedula = $request->get('cedula');
        $clients->phone = $request->get('phone');
        $clients->email = $request->get('email');
        $clients->users_id = $request->get('users_id');
        $clients->countries_id = $request->get('countries_id');
        $clients->zones_id = $request->get('zones_id');
        $clients->save();
        /* dd($clients); */

        session()->flash('success', 'Su registro se actualizo correctamente');
            return redirect()->route('admin.client.index');

        }catch(\Exception $e){

            session()->flash('error', 'Hubo un error al completar el formulario');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = Client::findOrFail($id);
        $clients->delete();
        session()->flash('success', 'Su registro se elimino correctamente');
        return redirect()->back();
    }
}
