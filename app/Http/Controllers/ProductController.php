<?php

namespace App\Http\Controllers;

use App\Models\brands;
use App\Models\category;
use App\Models\extrafields;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = category::all();
        $brands = brands::all();
        $extrafields = extrafields::all();
        return view('admin.products.create', compact('categories', 'brands', 'extrafields'));
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
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'second_sub_category_id' => 'required',
            'brand_id' => 'required',
            'extrafields_id' => 'required',
            'slug' => 'required',
            'summary' => 'required',
            'features' => 'required',
            'feature_image' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'status' => 'required',
            'is_featured' => 'required',
            'type' => 'required|in:new,popular',
            'stock' => 'required',
            'extra_fields' => 'required|array',
        ]);
        $product = $request->all();
        $product['uploader_id'] = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/products/';
            $image->move($path, $imageName);
            $product['image'] = $path . '/' . $imageName;
        }
        if ($request->hasFile('feature_image')) {
            $feature_image = $request->file('feature_image');
            $feature_imageName = 'feature_image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $feature_image->getClientOriginalExtension();
            $path = 'uploads/products/';
            $feature_image->move($path, $feature_imageName);
            $product['feature_image'] = $path . '/' . $feature_imageName;
        }
        if ($product['sub_category_id'] == null) {
            $product['category_id'] = $product['sub_category_id'];
        } else {
            $product['category_id'] = $product['sub_category_id'];
        }
        if ($product['second_sub_category_id'] == null) {
            $product['sub_category_id'] = $product['second_sub_category_id'];
        } else {
            $product['sub_category_id'] = $product['second_sub_category_id'];
        }

        
        $product['extra_fields'] = implode('|', $product['extra_fields']);



        Product::create($product);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $categories = category::all();
        $brands = brands::all();
        $extrafields = extrafields::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'extrafields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'extrafields_id' => 'required',
            'slug' => 'required',
            'features' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'status' => 'required',
            'type' => 'required|in:new,popular',
            'stock' => 'required',
        ]);
        $product->update($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'image' . now()->format('Y-m-d-H-is') . '.' . str::random(5) . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/products/';
            $image->move($path, $imageName);
            $product->image = $path . '/' . $imageName;
        }
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->route('products.index');
    }
}
