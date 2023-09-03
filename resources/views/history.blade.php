@extends('layouts.app')
@section('title','History')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-center bg-success text-light">{{ __('History Transaction') }}</div>
                    <table class="table table-responsive">
                        <thead>
                            <td>Nomor</td>
                            <td>Tanggal</td>
                            <td>Served By</td>
                            <td>Total</td>
                            <td>Payment</td>
                            <td>Opsi</td>
                        </thead>
                        @foreach ($history as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d F Y' , strtotime($history->created_at)) }}</td>
                            <td>{{ $history->user->name }}</td>
                            <td>{{ number_format($history->total) }}</td>
                            <td>{{ number_format($history->paytotal) }}</td>
                            <td>
                                <a href="{{ route('transaction.show',$history->id) }}" class="btn btn-primary">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
