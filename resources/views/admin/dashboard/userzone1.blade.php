@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Daftar User Aplikasi</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>No HP</th>
                            <th>Wallet</th>
                            <th>Total Produk</th>
                            <th>Subscribe</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>12 September 2020</td>
                            <td>Togamas</td>
                            <td>09274646545</td>
                            <td>Rp.10.000.000</td>
                            <td>30</td>
                            <td class="text-success">Aktif</td>
                        </tr>
                        <tr>
                            <td>12 September 2020</td>
                            <td>Uranus</td>
                            <td>09274646545</td>
                            <td>Rp.5.000.000</td>
                            <td>30</td>
                            <td class="text-danger">Tidak Aktif</td>
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
