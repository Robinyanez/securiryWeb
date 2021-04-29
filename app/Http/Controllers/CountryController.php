<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Imports\CountriesImport;
use Excel;
use Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
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

        $countries = new Country;
        $countries->name = $request->get('name');
        $countries->slug = Str::slug($request->get('name'),'-');
        $countries->description = $request->get('description');
        $countries->save();
        /* dd($countries); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.country.index');

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
        $countries = Country::findOrFail($id);
        return view('admin.country.edit', compact('countries'));
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

        $countries = Country::findOrFail($id);
        $countries->name = $request->get('name');
        $countries->slug = Str::slug($request->get('name'),'-');
        $countries->description = $request->get('description');
        $countries->save();
        /* dd($countries); */

        session()->flash('success', 'Su registro se ingreso correctamente');
            return redirect()->route('admin.country.index');

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

    public function importCountry(Request $request){

        $file = $request->file('file');

        Excel::import(new CountriesImport, $file);

        session()->flash('success', 'Sus registros se subieron correctamente');
        return redirect()->back();
    }
}
