@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Donasi</h1>
            <button type="button" class="btn btn-primary" title="Tambah Panti" data-toggle="modal" data-target="#createOrphanage">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah
            </button>
            @include('modal.create_orphanage')
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Panti / Yayasan</th>
                            <th>Nama Pengurus</th>
                            <th>Alamat</th>
                            <th>Total Donasi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($orphans as $orphan)
                        <tr>
                            <td>{{ $orphan['orphanage_name'] }}</td>
                            <td>{{ $orphan['orphanage_administrator'] }}</td>
                            <td>{{ $orphan['orphanage_address'] }}</td>
                            <td>Rp. {{number_format(0, 0, "", ",")}}</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-circle" href="{{ route('admin.donasi.show', ['id'=>1]) }}" title="Detail"><i class="fa fa-eye"></i></a>
                                <button type="button" class="btn btn-warning btn-circle" title="Edit" data-toggle="modal" data-target="#updateOrphanage-{{$orphan['id']}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="{{ route('admin.donasi.delete', $orphan['id']) }}" class="btn btn-circle btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-donasi-form-{{$orphan['id']}}').submit();"><i class="fa fa-times"></i></a>
                                <form action="{{ route('admin.donasi.delete', $orphan['id']) }}" id="delete-donasi-form-{{$orphan['id']}}" method="POST" style="display: none">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                </form>
                            </td>
                            @include('modal.edit_orphanage')
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
