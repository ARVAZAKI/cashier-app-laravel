@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Edit Item') }}</div>

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
                    <form action="{{ route('item.update',$item->id) }}" method="POST" class="" enctype ="multipart/form-data"  >
                        @csrf
                        {{ method_field('PUT') }}
                        <div class = "form-group">
                            <input type="hidden" class="form-control" id="category_id" name="category_id" value = "{{ $item->category_id}} ">
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
@endsection
