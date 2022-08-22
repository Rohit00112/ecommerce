@extends('admin.aside')
@section('product-create')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter slug">
                        </div>
                        <div class="form-group" id="category_id">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category__id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{--  subcategory  --}}
                        <div class="form-group" id="subcategory_id" style="display: none">
                            <label for="subcategory__id">Subcategory</label>
                            <select name="sub_category_id" id="subcategory__id" class="form-control">
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>
                        {{--  second subcategory  --}}
                        <div class="form-group" id="second_subcategory_id" style="display: none">
                            <label for="second_subcategory__id">Second Subcategory</label>
                            <select name="second_sub_category_id" id="second_subcategory__id" class="form-control">
                                <option value="">Select Second Subcategory</option>
                            </select>
                        </div>
                        <div id="extra_fields">

                        </div>
                        <div class="form-group">
                            <label for="brand_id">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                <option value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <textarea name="summary" id="summary" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="features">Features</label>
                            <textarea name="features" id="features" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="feature_image">Feature Image</label>
                            <input type="file" class="form-control" id="feature_image" name="feature_image">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter price">
                        </div>
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter discount">
                        </div>
                        <div class="form-group">
                            <label for="extrafields_id">Extra Fields</label>
                            <select name="extrafields_id" id="extrafields_id" class="form-control">
                                <option value="">Select Extra Fields</option>
                                @foreach ($extrafields as $extrafield)
                                    <option value="{{ $extrafield->id }}">{{ $extrafield->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>
                        {{--  is featured  --}}
                        <div class="form-group">
                            <label for="is_featured">Is Featured</label>
                            <select name="is_featured" id="is_featured" class="form-control">
                                <option value="">Select Is Featured</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        {{-- type --}}
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="new">New</option>
                                <option value="popular">Popular</option>
                            </select>
                        </div>
                        {{-- stock --}}
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" id="stock" name="stock" placeholder="Enter stock">
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
@section('scripts')
    <script>
        $('#category__id').change(function(e){
            e.preventDefault();
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('api.sub_cat') }}",
                type: 'POST',
                data: {id: category_id, _token: '{{ csrf_token() }}'},
                success: function(response){
                    if(response.status){
                        $('#subcategory_id').show();
                        $('#subcategory__id').empty();
                        $('#extra_fields').empty();
                        $('#extra_fields').append(response.extra_fields);
                        $('#subcategory__id').append('<option value="">Select Subcategory</option>');
                        var data = response.data;
                        $.each(data, function(index, value){
                            $('#subcategory__id').append('<option value="'+value.id+'">'+value.title+'</option>');
                        });
                    } else {
                        $('#subcategory_id').hide();
                        console.log(response.data);
                    }
                }
                
            });
        })
        $('#subcategory__id').change(function(e){
            e.preventDefault();
            var subcategory_id = $(this).val();
            $.ajax({
                url: "{{ route('api.sub_cat') }}",
                type: 'POST',
                data: {id: subcategory_id, _token: '{{ csrf_token() }}'},
                success: function(response){
                    if(response.status){
                        $('#second_subcategory_id').show();
                        $('#second_subcategory__id').empty();
                        $('#second_subcategory__id').append('<option value="">Select Second Subcategory</option>');
                        var data = response.data;
                        $.each(data, function(index, value){
                            $('#second_subcategory__id').append('<option value="'+value.id+'">'+value.title+'</option>');
                        });
                    } else {
                        $('#second_subcategory_id').hide();
                        console.log(response.data);
                    }
                }
                
            });
        })
    </script>
@endsection

