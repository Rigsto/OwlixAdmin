@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Push Notification</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex">
                <h1 class="h4 mb-0 font-weight-bold text-primary">Daftar Notifikasi</h1>
                <button type="button" class="btn btn-primary" title="Tambah Kategori" data-toggle="modal" data-target="#createNotif">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah
                </button>
                @include('modal.create_pushnotif')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable1">
                        <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Headline</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($datas as $data)
                        <tr>
                            <td>12 September 2020</td>
                            <td>Gemar Membaca</td>
                            <td>Membaca seru Deng..</td>
                            <td>Aktif</td>
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
            $('#dataTable1').DataTable();
        });
    </script>
@endsection
