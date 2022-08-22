@extends('admin.aside')
@section('product-edit')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter name" value="{{ $product->title }}">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug" value="{{ $product->slug }}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- brand --}}
                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select class="form-control" id="brand_id" name="brand_id">
                                <option value="">Select brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- summary --}}
                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <textarea class="form-control" id="summary" name="summary" rows="3">{{ $product->summary }}</textarea>
                        </div>
                        {{-- description --}}
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                        </div>
                        {{-- features --}}
                        <div class="form-group">
                            <label for="features">Features</label>
                            <textarea class="form-control" id="features" name="features" rows="3">{{ $product->features }}</textarea>
                        </div>
                        {{-- feature_image --}}
                        <div class="form-group">
                            <label for="feature_image">Feature Image</label>
                            <input type="file" class="form-control" id="feature_image" name="feature_image">
                        </div>
                        {{-- price --}}
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="{{ $product->price }}">
                        </div>
                        {{-- discount --}}
                        <div class="form-group">
                            <label for="discont">Discount</label>
                            <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter discount" value="{{ $product->discount }}">
                        </div>
                        {{-- extrafield_id --}}
                        <div class="form-group">
                            <label for="extrafield_id">Extrafield</label>
                            <select class="form-control" id="extrafields_id" name="extrafields_id">
                                <option value="">Select extrafield</option>
                                @foreach ($extrafields as $extrafield)
                                    <option value="{{ $extrafield->id }}" {{ $product->extrafields_id == $extrafield->id ? 'selected' : '' }}>{{ $extrafield->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- status --}}
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="">Select status</option>
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        {{-- is_featured --}}
                        <div class="form-group">
                            <label for="is_featured">Is Featured</label>
                            <select class="form-control" id="is_featured" name="is_featured">
                                <option value="">Select is featured</option>
                                <option value="1" {{ $product->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $product->is_featured == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        {{-- type --}}
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="">Select type</option>
                                <option value="new" {{ $product->type == 'new' ? 'selected' : '' }}>New</option>
                                <option value="popular" {{ $product->type == 'popular' ? 'selected' : '' }}>Popular</option>
                            </select>
                        </div>
                        {{-- stock --}}
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter stock" value="{{ $product->stock }}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection