<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

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
        return view('admin.user.create');
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
            'role' => 'required',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|unique:users,email|email',
        ]);

        try{

        $users = new User;
        $users->name = $request->get('name');
        $users->cedula = $request->get('cedula');
        $users->password = bcrypt($request->get('password'));
        $users->role = $request->get('role');
        $users->phone = $request->get('phone');
        $users->email = $request->get('email');
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
/*         $password = $users->password;
        $password = Crypt::decryptString($password); */
        return view('admin.user.edit', compact('users'));
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
            'role' => 'required',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min:10',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        try{

        $users = User::findOrFail($id);
        $users->name = $request->get('name');
        $users->cedula = $request->get('cedula');
        $users->password = bcrypt($request->get('password'));
        $users->role = $request->get('role');
        $users->phone = $request->get('phone');
        $users->email = $request->get('email');
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
        $users = Client::findOrFail($id);
        $users->delete();
        session()->flash('success', 'Su registro se elimino correctamente');
        return redirect()->back();
    }
}
