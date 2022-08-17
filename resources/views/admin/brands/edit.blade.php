@extends('admin.aside')
@section('brand-edit')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                {{-- add button --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header mr-4">
                            <h3 class="card-title">Brands</h3>
                            <div class="card-tools w-100 d-flex">
                                <a href="{{ route('brand.index') }}" class="btn btn-success" style="margin-left: auto">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter title" value="{{ $brand->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                        placeholder="Enter description">{{ $brand->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" value="{{ $brand->image }}">
                                </div>
                                <div class="form-group">
                                    <label for="icon">Icon</label>
                                    <input type="file" class="form-control" id="icon" name="icon" value="{{ $brand->icon }}">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection