@extends('admin.aside')
@section('category-edit')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            {{-- add button --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header mr-4">
                        <h3 class="card-title">Category</h3>
                        <div class="card-tools w-100 d-flex">
                            <a href="{{ route('category.index') }}" class="btn btn-success" style="margin-left: auto">
                                <i class="fa fa-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="sn">SN</label>
                                <input type="text" class="form-control" id="SN" name="SN" value="{{ $category->SN }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $category->title }}">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $category->slug }}">
                            </div>
                            {{--  image  --}}
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            {{--  icon  --}}
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="file" class="form-control" id="icon" name="icon">
                            </div>
                            {{-- summary --}}
                            <div class="form-group">
                                <label for="summary">Summary</label>
                                <textarea class="form-control" id="summary" name="summary" rows="3">{{ $category->summary }}</textarea>
                            </div>
                            {{-- is_parent --}}
                            <div class="form-group">
                                <label for="is_parent">Is Parent</label>
                                <select name="is_parent" onchange="showHide()" class="form-control" id="is_parent">
                                    <option value="1" {{ $category->is_parent == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $category->is_parent == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                            {{-- parent_id --}}
                            <div class="form-group" id="parent_id" style="display: {{ $category->is_parent == 1 ? 'block' : 'none' }}">
                                <label for="parent_id">Parent Id</label>
                                <select name="parent_id" class="form-control" id="parent_id">
                                    <option value="0">Select Parent</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $category->parent_id ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            {{--  -button  --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Save
                                </button>
                            </div>
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
</div>
<script>
    function showHide() {
        var is_parent = $('#is_parent').val();
        if (is_parent == 1) {
            $('#parent_id').hide();
        } else {
            $('#parent_id').show();
        }
    }
</script>
@endsection