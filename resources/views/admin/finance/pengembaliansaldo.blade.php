@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Pengembalian Saldo</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pembeli</th>
                            <th>Nama Mitra</th>
                            <th>Nominal</th>
                            <th>Nominal Pengembalian</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>26 Sep 2020</td>
                            <td>Hendy Kurniawan</td>
                            <td>Togamas</td>
                            <td>Rp. 50.000</td>
                            <td>Rp. 50.000</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-circle btn-info" title="Detail" data-toggle="modal" data-target="#pengembalianSaldo-1">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @include('modal.detail_pengembaliansaldo')
                                <a href="" class="btn btn-circle btn-primary" title="Cetak Struk"><i class="fa fa-print"></i></a>
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
