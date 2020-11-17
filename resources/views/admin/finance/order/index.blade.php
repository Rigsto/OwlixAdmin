@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Jumlah Order</h1>
        </div>
        <div class="card shadow mb-4">
{{--            <div class="card-header py-3">--}}
{{--                <h6 class="m-0 font-weight-bold text-primary">Omset Owlix per bulan</h6>--}}
{{--            </div>--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Invoice</th>
                            <th>Nama Pembeli</th>
                            <th>Status Bayar</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>26 Sep 2020 19.00</td>
                            <td>INV/1/200709473</td>
                            <td>Sekar Arum</td>
                            <td>Diterima</td>
                            <td>Rp. 50.000</td>
                            <td>
                                <a class="btn btn-info btn-circle" href="{{ route('admin.order.show', ['id'=>1]) }}" title="Order Detail"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
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
