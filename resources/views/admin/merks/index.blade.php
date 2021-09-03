@extends('layouts.app', ['class' => 'bg-secondary'])
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Merk</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Merk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- page content --}}
    <div class="container-fluid mt--6 ">
        <div class="row">
            <div class="col-md-8">
                {{-- session error --}}
                @if (session('error'))
                    <div class="alert alert-secondary text-danger" role="alert"><strong>{{ session('error') }}</strong>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header border-0">
                        <div class="mb-0">
                            <h4>Merk</h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- loop data --}}
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($merk as $val)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img src="{{ asset($val->takeImage()) }} " width="500px">
                                        </td>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->created_at->format('d-m-y') }}</td>
                                        <td>
                                            {{-- button trigger modal --}}
                                            {{-- edit --}}
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editModal{{ $val->id }}">
                                                Edit
                                            </button>
                                            {{-- delete --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $val->id }}">
                                                Delete
                                            </button>
                                            {{-- button trigger modal --}}
                                        </td>
                                    </tr>
                                    {{-- modal for edit Merk --}}
                                    <div class="modal fade" id="editModal{{ $val->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Modal</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('merk.update', $val->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-body ">
                                                        <div class="form-group">
                                                            <label for="name">Merk Name</label>
                                                            <input type="text" name="name" class="form-control" required
                                                                value="{{ $val->name }}">
                                                            @error('name')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <label for="image">Image</label>
                                                        <div class="input-group mb-3 rounded">
                                                            <div class="custom-file">
                                                                <input value="{{ $val->image }}" name="image" type="file"
                                                                    class="custom-file-input" value="{{ old('image') }}">
                                                                <label class="custom-file-label"
                                                                    for="inputGroupFile01">Choose
                                                                    file</label>
                                                            </div>
                                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt--4">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteModal{{ $val->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Modal</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure about this one ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">No</button>
                                                    <form action="{{ route('merk.destroy', $val->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end of modal --}}
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-dark">No Data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            {{-- Add New Merk Form --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header border-bottom">
                        Add New Merk
                    </div>
                    <div class="card-body">
                        <form action="{{ route('merk.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" id="name">Merk Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="image">Image</label>
                            <div class="input-group mb-3 rounded">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" value="{{ old('image') }}">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <p class="text-danger">{{ $errors->first('image') }}</p>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success ">Add New</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('js')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass('selected').html(fileName);
        })
    </script>
@endpush
