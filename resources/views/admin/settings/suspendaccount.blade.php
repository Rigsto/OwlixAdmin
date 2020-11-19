@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Suspend Akun</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nama Mitra</th>
                            <th>Expire Subscribe</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>Togamas</td>
                            <td>29 September 2020</td>
                            <td>Active</td>
                            <td style="width: 200px">
                                <a href="" class="btn btn-success">Activate</a>
                                <a href="" class="btn btn-danger">Deactivate</a>
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
