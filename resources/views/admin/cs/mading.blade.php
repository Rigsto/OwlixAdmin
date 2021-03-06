@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Mading / Info</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 justify-content-between d-flex">
                <h1 class="h4 mb-0 font-weight-bold text-primary">Daftar Mading</h1>
                <button type="button" class="btn btn-primary" title="Tambah Kategori" data-toggle="modal" data-target="#createMading">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah
                </button>
                @include('modal.create_mading')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable1">
                        <thead class="thead-dark">
                        <tr>
                            <th>Halaman</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($madings as $mading)
                        <tr>
                            <td>{{$mading['title']}}</td>
                            <td>{{$categories[$mading['id_mading_category']]}}</td>
                            <td>{{$mading['is_active'] == "TRUE" ? "Aktif" : "Tidak Aktif"}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-circle" title="Edit" data-toggle="modal" data-target="#updateMading-{{$mading['id']}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="{{ route('admin.info.delete', $mading['id']) }}" class="btn btn-circle btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-mading-form-{{$mading['id']}}').submit();"><i class="fa fa-times"></i></a>
                                <form action="{{ route('admin.info.delete', $mading['id']) }}" id="delete-mading-form-{{$mading['id']}}" method="POST" style="display: none">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                </form>
                            </td>
                            @include('modal.edit_mading')
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
