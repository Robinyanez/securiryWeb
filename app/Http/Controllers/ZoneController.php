<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;
use App\Imports\ZonesImport;
use Excel;
use Str;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.zone.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.zone.create');
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
            'phone' => 'numeric|min:10',
            'email' => 'unique:zones,email|email',
        ]);

        try{

        $zones = new Zone;
        $zones->name = $request->get('name');
        $zones->slug = Str::slug($request->get('name'),'-');
        $zones->phone = $request->get('phone');
        $zones->email = $request->get('email');
        $zones->save();
        /* dd($zones); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.zone.index');

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
        $zones = Zone::findOrFail($id);
        return view('admin.zone.edit', compact('zones'));
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
            'phone' => 'numeric|min:10',
            'email' => 'email|unique:zones,email,'.$id,
        ]);

        try{

        $zones = Zone::findOrFail($id);
        $zones->name = $request->get('name');
        $zones->slug = Str::slug($request->get('name'),'-');
        $zones->phone = $request->get('phone');
        $zones->email = $request->get('email');
        $zones->save();
        /* dd($zones); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.zone.index');

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
        //
    }

    public function importZone(Request $request){

        $file = $request->file('file');

        Excel::import(new ZonesImport, $file);

        session()->flash('success', 'Sus registros se subieron correctamente');
        return redirect()->back();
    }
}
