@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Donasi</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Panti / Yayasan</th>
                            <th>Nama Pengurus</th>
                            <th>Alamat</th>
                            <th>Total Donasi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>Panti Asuhan Muhammadiyah</td>
                            <td>Pak Agus</td>
                            <td>Jl. Mayjend Sungkono</td>
                            <td>Rp. 500.000</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-circle" href="{{ route('admin.donasi.show', ['id'=>1]) }}" title="Detail"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-danger btn-circle" href="" title="Delete"><i class="fa fa-trash"></i></a>
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
