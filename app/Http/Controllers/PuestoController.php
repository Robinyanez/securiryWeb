<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puesto;
use App\Imports\PuestosImport;
use Excel;
use Str;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.puesto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.puesto.create');
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
            'name'          => 'required',
        ]);

        try{

        $puestos = new Puesto;
        $puestos->name = $request->get('name');
        $puestos->slug = Str::slug($request->get('name'),'-');
        $puestos->description = $request->get('description');
        $puestos->save();
        /* dd($puestos); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.puesto.index');

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
        $puestos = Puesto::findOrFail($id);
        return view('admin.puesto.edit', compact('puestos'));
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
            'name'  => 'required',
        ]);

        try{

        $puestos = Puesto::findOrFail($id);
        $puestos->name = $request->get('name');
        $puestos->slug = Str::slug($request->get('name'),'-');
        $puestos->description = $request->get('description');
        $puestos->save();
        /* dd($puestos); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.puesto.index');

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

    public function importPuesto(Request $request){

        $file = $request->file('file');

        Excel::import(new PuestosImport, $file);

        session()->flash('success', 'Sus registros se subieron correctamente');
        return redirect()->back();
    }
}
