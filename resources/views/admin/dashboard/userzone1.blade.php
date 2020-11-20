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
                            <th>Name</th>
                            <th>No HP</th>
                            <th>Wallet</th>
                            <th>Total Produk</th>
                            <th>Subscribe</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($users as $user)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($user['created_at'])->toFormattedDateString() }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['phone_number'] }}</td>
                            <td>Rp. {{ number_format($user['balance'], 0, ",", ".") }}</td>
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
