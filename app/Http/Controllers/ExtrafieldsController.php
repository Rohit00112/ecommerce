<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\extrafields;
use Illuminate\Http\Request;

class ExtrafieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.extrafields.index', ['extrafields' => extrafields::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.extrafields.create')->with('categories', category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'value' => 'required',
        ]);
        $extrafield = $request->all();
        extrafields::create($extrafield);
        return redirect()->route('extrafields.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\extrafields  $extrafields
     * @return \Illuminate\Http\Response
     */
    public function show(extrafields $extrafields)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\extrafields  $extrafields
     * @return \Illuminate\Http\Response
     */
    public function edit(extrafields $extrafields)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\extrafields  $extrafields
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, extrafields $extrafields)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\extrafields  $extrafields
     * @return \Illuminate\Http\Response
     */
    public function destroy(extrafields $extrafields)
    {
        //
    }
}
