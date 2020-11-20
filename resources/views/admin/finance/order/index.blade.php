@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Jumlah Order</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Invoice</th>
                            <th>Nama Pembeli</th>
                            <th>Status Bayar</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($order['created_at']))->setTimeZone('Asia/Jakarta')->toDateTimeString() }}</td>
                            <td>{{ $order['external_id'] }}</td>
                            <td>{{ $order['id_customer'] }}</td>
                            @if($order['status'] == 'NEW')
                                <td class="text-uppercase text-warning">Menunggu Pembayaran</td>
                            @elseif($order['status'] == 'PAID')
                                <td class="text-uppercase text-primary">Diterima</td>
                            @elseif($order['status'] == 'REJECTED')
                                <td class="text-uppercase text-danger">Dibatalkan</td>
                            @endif
                            <td>{{ $order['status'] }}</td>
                            <td>Rp. {{ number_format($order['amount'] + $order['delivery_expense'], 0, ",", ".") }}</td>
                            <td>
                                <a class="btn btn-info btn-circle" href="{{ route('admin.order.show', ['id'=>1]) }}" title="Order Detail"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            $('#dataTable').DataTable();
        });
    </script>
@endsection
