@extends('admin.aside')
@section('category-create')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mr-4">
                    <h3 class="card-title">Category</h3>
                    <div class="card-tools w-100 d-flex">
                        <a href="{{ route('category.index') }}" class="btn btn-success" style="margin-left: auto">
                            <i class="fa fa-list"></i>
                            List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{--  -SN  --}}
                        <div class="form-group">
                            <label for="SN">SN</label>
                            <input type="text" class="form-control" id="SN" name="SN" placeholder="SN" value="{{ old('SN') }}">
                            @error('SN')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Enter Slug">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="file" name="icon" class="form-control" id="icon">
                        </div>
                        
                        <div class="form-group">
                            <label for="summary">Summary</label>
                            <textarea name="summary" class="form-control" id="summary" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="is_parent">Is Parent</label>
                            <select name="is_parent" onchange="showHide()" class="form-control" id="is_parent">
                                <option value="1" >Yes</option>
                                <option value="0" >No</option>
                            </select>
                        </div>
                        <div class="form-group" id="parent_id" style="display: none">
                            <label for="parent_id">Parent Id</label>
                            <select name="parent_id" class="form-control" id="parent__id">
                                <option value="">No Parent</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="sec_parent_id" style="display: none">
                            <label for="sec_parent_id">Parent Id</label>
                            <select name="sec_parent_id" class="form-control" id="sec__parent_id">
                                <option value="">No Parent</option>
                            </select>
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
    function showHide() {
        var is_parent = $('#is_parent').val();
        if (is_parent == 1) {
            $('#parent_id').hide();
        } else {
            $('#parent_id').show();
        }
    }
    $('#parent__id').change(function (e) { 
        e.preventDefault();
        var id = $(this).val();
        $.ajax({
            url: "{{ route('api.sub_cat') }}",
            type: 'POST',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if(response.status){
                    $('#sec_parent_id').show();
                    $('#sec__parent_id').empty();
                    $('#sec__parent_id').append('<option value="">No Parent</option>');
                    var data = response.data;
                    $.each(data, function (indexInArray, valueOfElement) { 
                         $('#sec__parent_id').append('<option value="' + valueOfElement.id + '">' + valueOfElement.title + '</option>');
                    });
                }else{
                    $('#sec_parent_id').hide();
                }
            }
        });
    });
</script>
@endsection