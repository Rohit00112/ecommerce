@extends('admin.aside')
@section('category-index')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mr-4">
                    <h3 class="card-title">Category</h3>
                    <div class="card-tools w-100 d-flex">
                        <a href="{{ route('category.create') }}" class="btn btn-success" style="margin-left: auto">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    SN
                                </th>
                                <th>
                                   Title
                                </th>
                                <th>
                                    Slug
                                </th>
                                <th>
                                    Image
                                </th>
                                <th>
                                    icon
                                </th>
                                <th>
                                    summary
                                </th>
                                <th>
                                    is_parent
                                </th>
                                <th>
                                    parent_id
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->SN }}
                                        </td>
                                        <td>
                                            {{ $category->title }}
                                        </td>
                                        <td>
                                            {{ $category->slug }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('uploads/category/'.$category->image) }}" alt="{{ $category->title }}" width="100">
                                        </td>
                                        <td>
                                            <img src="{{ asset('uploads/category/'.$category->icon) }}" alt="{{ $category->title }}" width="100">
                                        </td>
                                        <td>
                                            {{ $category->summary }}
                                        </td>
                                        <td>
                                            {{ $category->is_parent }}
                                        </td>
                                        <td>
                                            {{ $category->parent_id }}
                                        </td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit">Edit</i>
                                            </a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash">Delete</i>
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
@endsection
