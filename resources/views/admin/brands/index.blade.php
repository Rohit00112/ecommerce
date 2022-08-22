@extends('admin.aside')
@section('brand-index')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            {{-- add button --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header mr-4">
                        <h3 class="card-title">Brands</h3>
                        <div class="card-tools w-100 d-flex">
                            <a href="{{ route('brand.create') }}" class="btn btn-success" style="margin-left: auto">
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
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Icon</th>
                                        <th>Description</th>
                                        <th>Uploader</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td>{{ $brand->title }}</td>
                                            <td>
                                                <img src="{{ asset($brand->image) }}" alt="{{ $brand->title }}" width="100">
                                            </td>
                                            <td>
                                                <img src="{{ asset($brand->icon) }}" alt="{{ $brand->title }}" width="100">
                                            </td>
                                            <td>{{ $brand->description }}</td>
                                            <td>{{ $brand->uploader_id }}</td>
                                            <td>
                                                <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                    
                                                </a>
                                                <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" class="d-inline-block">
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