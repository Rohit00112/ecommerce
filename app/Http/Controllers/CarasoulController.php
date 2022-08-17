<?php

namespace App\Http\Controllers;

use App\Models\carasoul;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CarasoulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.carasoul.index', ['carasouls' => carasoul::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.carasoul.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/carasoul/';
            $image->move($path, $imageName);
            $data['image'] = $path . '/' . $imageName;
        }
        carasoul::create($data);
        return redirect()->route('carasoul.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\carasoul  $carasoul
     * @return \Illuminate\Http\Response
     */
    public function show(carasoul $carasoul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\carasoul  $carasoul
     * @return \Illuminate\Http\Response
     */
    public function edit(carasoul $carasoul)
    {
        //
        return view('admin.carasoul.edit', ['carasoul' => $carasoul]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\carasoul  $carasoul
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, carasoul $carasoul)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/carasoul/';
            $image->move($path, $imageName);
            $data['image'] = $path . '/' . $imageName;
        }
        $carasoul->update($data);
        return redirect()->route('carasoul.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\carasoul  $carasoul
     * @return \Illuminate\Http\Response
     */
    public function destroy(carasoul $carasoul)
    {
        //
        $carasoul->delete();
        return redirect()->route('carasoul.index');
    }
}
