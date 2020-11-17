@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Panti Asuhan Muhammadiyah</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>26 Sep 2020 19.00</td>
                            <td>Sekar Arum</td>
                            <td>Rp. 500</td>
                        </tr>
                        <tr>
                            <td>26 Sep 2020 19.00</td>
                            <td>Hendy Kurniawan</td>
                            <td>Rp. 500</td>
                        </tr>
                        <tr>
                            <td>26 Sep 2020 19.00</td>
                            <td>David Widjaya</td>
                            <td>Rp. 500</td>
                        </tr>
                        <tr>
                            <td>26 Sep 2020 19.00</td>
                            <td>Hendy Kurniawan</td>
                            <td>Rp. 500</td>
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
