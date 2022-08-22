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
            'icon' => 'nullable',
            'summary' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
            'sec_parent_id' => 'nullable|exists:categories,id',
            'is_parent' => 'in:0,1',
        ]);
        $category = $request->all();
        if($request->is_parent == 1){
            $category['parent_id'] = null;
        }else{
            if($request->sec_parent_id == null){
                $category['parent_id'] = $request->parent_id;
            }else{
                $category['parent_id'] = $request->sec_parent_id;
            }
        }
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

    public function subCats(Request $request)
    {
        $category = category::find($request->id);
        if($category == null){
            return response()->json([
                'status' => false,
                'data' => $request->id,
            ]);
        }
        $outupt = '';
        foreach ($category->extraFields as  $extra) {
            $select_opt = explode(',', $extra->value);
            $outupt .= '<div class="form-group">
                            <label for="'.$extra->name.'">'.$extra->name.'</label>
                            <select class="form-control" name="extra_fields[]">';
            foreach ($select_opt as  $opt) {
                $outupt .= '<option value="'.$opt.'">'.$opt.'</option>';
            }
            $outupt .= '</select>
                        </div>';
        }
        return response()->json([
            'status' => true,
            'extra_fields' => $outupt,
            'data' => $category->subCategories,
        ]);
    }
}
