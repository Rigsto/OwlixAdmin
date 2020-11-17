@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Pengajuan Voucher</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nama Mitra</th>
                            <th>Kode Voucher</th>
                            <th>Jumlah Voucher</th>
                            <th>Potongan Harga</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>Togamas</td>
                            <td>BACABUKUYUK</td>
                            <td>1 (10 Transaksi)</td>
                            <td>Rp. 5.000<br>Min. belanja 50.000</td>
                            <td class="text-center">
                                <a class="btn btn-success btn-circle" href="" title="Accept"><i class="fa fa-check"></i></a>
                                <a class="btn btn-danger btn-circle" href="" title="Reject"><i class="fa fa-times"></i></a>
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
