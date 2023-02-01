@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Transaction') }}</div>
            </div>
        </div> --}}
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">{{ __('Detail Transaction') }}</div>
                <div class="container">
                    <h6 class="mt-1">Date : {{ date('d F Y' , strtotime($detail->created_at)) }}</h6>
                    <h6>Served by : {{ $detail->user->name }}</h6>
                </div>
                </table>
                    <table class="table table-responsive">
                        <thead>
                            <td>Nomor</td>
                            <td>Nama item</td>
                            <td>Qty</td>
                            <td>Price(per item)</td>
                            <td>Subtotal</td>
                        </thead>
                        @foreach ($detail->detail as $dtl)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dtl->item->name }}</td>
                            <td>{{ $dtl->quantity }}</td>
                            <td>{{ number_format($dtl->item->prices) }}</td>
                            <td>{{ number_format($dtl->quantity * $dtl->item->prices) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-end">Total</td>
                            <td>=</td>
                            <td>{{ number_format($detail->total) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-end">Payment</td>
                            <td>=</td>
                            <td>{{ number_format($detail->paytotal) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="text-end">Kembalian</td>
                            <td>=</td>
                            <td>{{ number_format($detail->paytotal - $detail->total) }}</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
