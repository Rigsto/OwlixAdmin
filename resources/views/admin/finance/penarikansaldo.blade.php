@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Penarikan Saldo</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>No. Rekening</th>
                            <th>Nominal</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>26 Sep 2020</td>
                            <td>Hendy Shop</td>
                            <td>Mitra</td>
                            <td>13543637</td>
                            <td>Rp. 200.000</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-circle btn-info" title="Details" data-toggle="modal" data-target="#penarikanSaldo-1">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @include('modal.detail_penarikansaldo')
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
