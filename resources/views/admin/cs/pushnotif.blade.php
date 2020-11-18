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
                        <tr>
                            <td>12 September 2020</td>
                            <td>Gemar Membaca</td>
                            <td>Membaca seru Deng..</td>
                            <td>Aktif</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-circle" title="Edit" data-toggle="modal" data-target="#updateNotif-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="{{ route('admin.notif.delete', 1) }}" class="btn btn-circle btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-notif-form').submit();"><i class="fa fa-times"></i></a>
                                <form action="{{ route('admin.notif.delete', 1) }}" id="delete-notif-form" method="POST" style="display: none">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                </form>
                            </td>
                            @include('modal.edit_pushnotif')
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
            $('#dataTable1').DataTable();
            $('#dataTable2').DataTable();
        });
    </script>
@endsection
