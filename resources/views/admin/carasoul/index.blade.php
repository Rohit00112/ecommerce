@extends('admin.aside')
@section('carousel-index')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                {{-- add button --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header mr-4">
                            <h3 class="card-title">Carousel</h3>
                            <div class="card-tools w-100 d-flex">
                                <a href="{{ route('carasoul.create') }}" class="btn btn-success" style="margin-left: auto">
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
                                            <th>URL</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carasouls as $carasoul)
                                            <tr>
                                                <td>{{ $carasoul->id }}</td>
                                                <td>{{ $carasoul->title }}</td>
                                                <td>{{ $carasoul->url }}</td>
                                                <td>
                                                    <img src="{{ asset($carasoul->image)  }}" alt="{{ $carasoul->title }}"
                                                        width="100px" height="100px">

                                                </td>
                                                <td>{{ $carasoul->description }}</td>
                                                <td>
                                                    <a href="{{ route('carasoul.edit', $carasoul->id) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('carasoul.destroy', $carasoul->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
