@extends('admin.aside')
@section('extrafield-index')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            {{-- add button --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header mr-4">
                        <h3 class="card-title">Extra Fields</h3>
                        <div class="card-tools w-100 d-flex">
                            <a href="{{ route('extrafields.create') }}" class="btn btn-success" style="margin-left: auto">
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
                                        <th>Value</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($extrafields as $extrafield)
                                        <tr>
                                            <td>{{ $extrafield->id }}</td>
                                            <td>{{ $extrafield->name }}</td>
                                            <td>{{ $extrafield->value }}</td>
                                            <td>{{ $extrafield->category? $extrafield->category->title : '-' }}</td>

                                            <td>
                                                <a href="{{ route('extrafields.edit', $extrafield->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('extrafields.destroy', $extrafield->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                        Delete
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