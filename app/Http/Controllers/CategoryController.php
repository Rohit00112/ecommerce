<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.category.index', ['categories' => category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create')->with('categories', category::all());
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
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'icon' => 'required',
            'summary' => 'required',
            // 'parent_id' => 'required',
            'is_parent' => 'in:0,1',
        ]);
        $category = $request->all();
        $category['uploader_id'] = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/category/';
            $image->move($path, $imageName);
            $category['image'] = $path . '/' . $imageName;
        }
        category::create($category);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
        return view('admin.category.edit', ['category' => $category])->with('categories', category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'icon' => 'required',
            'summary' => 'required',
            // 'parent_id' => 'required',
            'is_parent' => 'in:0,1',
        ]);
        
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/category/';
            $image->move($path, $imageName);
            $data['image'] = $path . '/' . $imageName;
        }
        $category->update($data);
        return redirect()->route('category.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        //
        $category->delete();
        return redirect()->route('category.index');
    }
}
