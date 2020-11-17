@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Omset Owlix</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Bulan/Tahun</th>
                                <th>Subscribe</th>
                                <th>Biaya Admin</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>September/2020</td>
                            <td>Rp. 10.000.000</td>
                            <td>Rp. 1.000.000</td>
                            <td>Rp. 11.000.000</td>
                        </tr>
                        <tr>
                            <td>Oktober/2020</td>
                            <td>Rp. 12.000.000</td>
                            <td>Rp. 2.000.000</td>
                            <td>Rp. 14.000.000</td>
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
