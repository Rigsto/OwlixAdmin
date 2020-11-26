@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Kategori</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 justify-content-between d-flex">
                        <h1 class="h4 mb-0 font-weight-bold text-primary">Kategori Toko</h1>
                        <button type="button" class="btn btn-primary" title="Tambah Kategori" data-toggle="modal" data-target="#createToko">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Kategori Toko
                        </button>
                        @include('modal.create_kategoriToko')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="dataTable1">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-800">
                                @foreach($partners as $partner)
                                    <tr>
                                        <td>{{ $partner['name'] }}</td>
                                        <td>Aktif</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-circle" title="Edit" data-toggle="modal" data-target="#updateToko-{{$partner['id']}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a href="{{ route('admin.category.toko.delete', $partner['id']) }}" class="btn btn-circle btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-toko-form-{{$partner['id']}}').submit();"><i class="fa fa-times"></i></a>
                                            <form action="{{ route('admin.category.toko.delete', $partner['id']) }}" id="delete-toko-form-{{$partner['id']}}" method="POST" style="display: none">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                            </form>
                                        </td>
                                        @include('modal.edit_kategoriToko')
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 justify-content-between d-flex">
                        <h1 class="h4 mb-0 font-weight-bold text-primary">Kategori Produk</h1>
                        <button type="button" class="btn btn-primary" title="Tambah Kategori" data-toggle="modal" data-target="#createItem">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Kategori Produk
                        </button>
                        @include('modal.create_kategoriItem')
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="dataTable2">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-800">
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>Aktif</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-circle" title="Edit" data-toggle="modal" data-target="#updateItem-{{$item['id']}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <a href="{{ route('admin.category.item.delete', $item['id']) }}" class="btn btn-circle btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-item-form-{{$item['id']}}').submit();"><i class="fa fa-times"></i></a>
                                            <form action="{{ route('admin.category.item.delete', $item['id']) }}" id="delete-item-form-{{$item['id']}}" method="POST" style="display: none">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                            </form>
                                        </td>
                                        @include('modal.edit_kategoriItem')
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
