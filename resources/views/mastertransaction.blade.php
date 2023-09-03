@extends('layouts.app')
@section('title','Transaction')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-success text-light text-center">{{ __('Transaction') }}</div>
                <div class="card-body">
                    <table class="table table-responsive-lg">
                        <thead>
                            <td>Nomor</td>
                            <td>Category</td>
                            <td>Nama</td>
                            <td>Harga</td>
                            <td>Stock</td>
                            <td>Action</td>
                        </thead>
                        {{-- @if($cart->isEmpty()) --}}
                        {{-- <tr>
                            <td class="text-center" colspan="5">
                                item already in cart
                            </td>
                        </tr>
                        @else --}}
                        @foreach ($item as $item)
                        <tr>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->prices) }}</td>
                            <td>{{ $item->stock }}</td>
                            <form action="{{ route('transaction.store') }}" method="POST">
                                @csrf
                                <td>
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="btn btn-sm btn-success text-light">Add</button>
                                </td>
                            </form>

                        </tr>
                        @endforeach
                        {{-- @endif --}}
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-success text-light text-center">{{ __('Cart') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-responsive">
                        <thead>
                            <td>Nomor</td>
                            <td>Nama item</td>
                            <td>Jumlah</td>
                            <td>Subtotal</td>
                            <td>Action</td>
                        </thead>
                        @if($cart->isEmpty())
                        <tr>
                            <td class="text-center" colspan="5">
                                no item here
                            </td>
                        </tr>
                        @else
                        @foreach ($cart as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>
                                <form action="{{ route('transaction.update',$data->cart->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <input class="form-control" min="1" max="{{ $data->stock }}" type="number" value="{{ $data->cart->qty }}" name="qty" id="" onchange="ubah{{ $loop->iteration }}()">
                                <td>{{ number_format($data->prices * $data->cart->qty) }}</td>
                                <td>
                                        <button class="btn btn-warning" id = "update{{ $loop->iteration }}" style="display: none">Update</button>
                                    </form>
                                    <form action="{{ route('transaction.destroy',$data->cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" id = "hapus{{ $loop->iteration }}" style="display">Hapus</button>
                                </form>
                                </td>
                                <script>
                                    function ubah{{ $loop->iteration }}(){
                                        document.getElementById("update{{ $loop->iteration }}").style.display="inline";
                                        document.getElementById("hapus{{ $loop->iteration }}").style.display="none";
                                    }
                                </script>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <form action="{{ route('transaction.checkout') }}" method="POST">
                            @csrf
                            <tr>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <td colspan="2">Total</td>
                                <td colspan="4">
                                    <input type="number" class="form-control" name="total" id="total"
                                    value="{{ $cart->sum(function($item){
                                        return $item->prices * $item->cart->qty;
                                    }) }}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Payment</td>
                                <td colspan="4">
                                    <input type="number" required class="form-control" name="paytotal" id="paytotal"
                                    value="{{ old('paytotal') }}">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="1">
                                    <input class="btn btn-primary" type="submit">
                                </td>
                                <td colspan="1">
                                    <input class="btn btn-warning" type="reset" value="reset" id="">
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
