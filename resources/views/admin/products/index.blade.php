@extends('admin.aside')
@section('product-index')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            {{-- add button --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header mr-4">
                        <h3 class="card-title">Products</h3>
                        <div class="card-tools w-100 d-flex">
                            <a href="{{ route('products.create') }}" class="btn btn-success" style="margin-left: auto">
                                <i class="fa fa-plus"></i>
                                Add New
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->category? $product->category->title : '-' }}</td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                    
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                        
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection