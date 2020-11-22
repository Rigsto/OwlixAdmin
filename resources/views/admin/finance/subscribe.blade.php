@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Subscribe</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nama Mitra</th>
                            <th>Tanggal Pembelian</th>
                            <th>Berlaku Hingga</th>
                            <th>Pembayaran</th>
                            <th>Nominal</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($datas as $data)
                        <tr>
                            <td>{{ $data['name'] }}</td>
                            <td>-</td>
                            <td>{{ \Carbon\Carbon::parse($data['expired_date'])->setTimezone('Asia/Jakarta')->toFormattedDateString() }}</td>
                            <td>-</td>
                            <td>-</td>
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
