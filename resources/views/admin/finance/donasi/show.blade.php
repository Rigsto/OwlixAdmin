@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">{{$orphan['orphanage_name']}}</h1>
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
                        @foreach($donations as $donation)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($donation['created_at'])->setTimezone('Asia/Jakarta')->toFormattedDateString()}}</td>
                                <td>{{$donation['name']}}</td>
                                <td>{{$donation['total']}}</td>
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
