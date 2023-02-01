@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Master Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-responsive">
                        <thead>
                            <td>Nomor</td>
                            <td>Nama Category</td>
                            <td>Action</td>
                        </thead>
                        @foreach ($category as $item)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('category.edit',$item->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route("category.hapus", $item->id) }}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}</div>

                <div class="card-body">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors -> all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('category.store') }}" method="POST" enctype ="multipart/form-data">
                        @csrf
                        <label for="">Nama Category</label>
                        <input class="form-control mb-3" type="text" name="name" id="name" value="{{ old('name') }}">
                        <div class="form-group">
                            <input type ="submit" class="btn btn-success" value="Simpan">
                            <a href="{{ route('category.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
