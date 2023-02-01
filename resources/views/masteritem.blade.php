@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Master Item') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-responsive">
                        <thead>
                            <td>Nomor</td>
                            <td>Category</td>
                            <td>Nama</td>
                            <td>Harga</td>
                            <td>Stock</td>
                            <td>Action</td>
                        </thead>
                        @foreach($item as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->category->name }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{number_format($data->prices)}}</td>
                            <td>{{ $data->stock }}</td>
                            <td>
                                <a href="{{ route('item.edit',$data->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route("item.hapus", $data->id) }}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Add item') }}</div>

                <div class="card-body">
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

                    <form method="POST" action="{{ route('item.store') }}" enctype ="multipart/form-data" >
                        @csrf
                        <div class="form-group mb-1">
                            <label for="">Category</label>
                        <select class="form-control form-select" name="category_id" id="category_id">
                            @foreach($category as $cg)
                            <option value="{{ $cg->id }}">{{ $cg->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="">Nama</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name')}}">
                        </div>
                        <div class="form-group mb-1">
                            <label for="">Harga</label>
                            <input class="form-control" type="number" name="prices" id="prices" value="{{ old('prices')}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Stock</label>
                            <input class ="form-control" type="number" name="stock" id="stock" value="{{ old('stock')}}">
                        </div>
                        <div class="form-group">
                            <input type ="submit" class="btn btn-success" value="Simpan">
                            <a href="{{ route('item.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
