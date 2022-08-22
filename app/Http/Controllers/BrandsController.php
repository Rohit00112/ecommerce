<?php

namespace App\Http\Controllers;

use App\Models\brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.brands.index', ['brands' => brands::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brands.create');
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
            'title' => 'required',
            'image' => 'required',
            'icon' => 'required',
            'description' => 'required',
        ]);
        $brand = $request->all();
        $brand['uploader_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/brands/';
            $image->move($path, $imageName);
            $brand['image'] = $path . '/' . $imageName;
        }
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconName = 'icon' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $icon->getClientOriginalExtension();
            $path = 'uploads/brands/';
            $icon->move($path, $iconName);
            $brand['icon'] = $path . '/' . $iconName;
        }
        brands::create($brand);
        return redirect()->route('brand.index')->with('success', 'Brand created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function show(brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function edit($brands)
    {
        //
        return view('admin.brands.edit')->with('brand', brands::findorfail($brands));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$brands)
    {
        //
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);
        $brands = brands::findorfail($brands);
        $brand = $request->all();
        $brand['uploader_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/brands/';
            $image->move($path, $imageName);
            $brand['image'] = $path . '/' . $imageName;
        }
        $brands->update($brand);
        return redirect()->route('brand.index')->with('success', 'Brand updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brands  $brands
     * @return \Illuminate\Http\Response
     */
    public function destroy( $brands)
    {
        //
        $brands = brands::findorfail($brands);
        $brands->delete();
        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully');
    }
}
