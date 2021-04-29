<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Puesto;
use App\Models\Cargo;
use Illuminate\Support\Facades\Crypt;
use App\Imports\UsersImport;
use Excel;
use Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puestos = Puesto::orderBy('name')->get();
        $cargos = Cargo::orderBy('name')->get();
        $clients = Client::with('ciudad')->orderBy('name')->get();
        return view('admin.user.create', compact('clients','puestos','cargos'));
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
            'cedula' => 'required|unique:users,cedula',
            'password' => 'required|min:8',
            'phone' => 'numeric|min:10',
            'email' => 'unique:users,email|email',
            'client_id' => 'required',
            'puesto_id' => 'required',
            'cargo_id' => 'required',
        ]);

        try{

        $users = new User;
        $users->name = $request->get('name');
        $users->slug = Str::slug($request->get('name'),'-');
        $users->cedula = $request->get('cedula');
        $users->password = bcrypt($request->get('password'));
        $users->phone = $request->get('phone');
        $users->email = $request->get('email');
        $users->client_id = $request->get('client_id');
        $users->puesto_id = $request->get('puesto_id');
        $users->cargo_id = $request->get('cargo_id');
        $users->save();
        /* dd($users); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.user.index');

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
        $users = User::findOrFail($id);
        $puestos = Puesto::orderBy('name')->get();
        $cargos = Cargo::orderBy('name')->get();
        $clients = Client::with('ciudad')->orderBy('name')->get();
        return view('admin.user.edit', compact('users','clients','puestos','cargos'));
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
            'cedula' => 'required|unique:users,cedula,'.$id,
            'password' => 'required|min:8',
            'phone' => 'numeric|min:10',
            'email' => 'email|unique:users,email,'.$id,
            'client_id' => 'required',
            'puesto_id' => 'required',
            'cargo_id' => 'required',
        ]);

        try{

        $users = User::findOrFail($id);
        $users->name = $request->get('name');
        $users->slug = Str::slug($request->get('name'),'-');
        $users->cedula = $request->get('cedula');
        $users->password = bcrypt($request->get('password'));
        $users->phone = $request->get('phone');
        $users->email = $request->get('email');
        $users->client_id = $request->get('client_id');
        $users->puesto_id = $request->get('puesto_id');
        $users->cargo_id = $request->get('cargo_id');
        $users->save();
        /* dd($users); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.user.index');

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
        $users = User::findOrFail($id);
        /* $users->delete(); */
        dd($users);
        session()->flash('success', 'Su registro se elimino correctamente');
        return redirect()->back();
    }

    public function importUser(Request $request){

        $file = $request->file('file');

        Excel::import(new UsersImport, $file);

        session()->flash('success', 'Sus registros se subieron correctamente');
        return redirect()->back();
    }

    public function profile(){

    }

}
