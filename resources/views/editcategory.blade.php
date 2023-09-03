@extends('layouts.app')
@section('title','Edit category')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-success text-light text-center">{{ __('Edit Category') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('category.update',$category->id) }}" method="POST" class="" enctype ="multipart/form-data"  >
                        @csrf
                        {{ method_field('PUT') }}
                        <h6>Nama category</h6>
                        <input class="form-control mb-3" type="text" name="name" id="name" value="{{ old('name')}}">
                        <input class="btn btn-success" type="submit" value="Simpan">
                        {{-- <a href="" class="btn btn-success">Simpan</a> --}}
                        {{-- <input href = "" class="btn btn-danger" type="button" value="Batal"> --}}
                        <a href="/category" class="btn btn-danger">Batal</a>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
