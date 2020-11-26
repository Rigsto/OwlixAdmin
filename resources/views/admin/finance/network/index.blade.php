@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Owlix Network</h1>
            <a href="{{ route('admin.network.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Berlaku Hingga</th>
                            <th>No HP</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($needs as $need)
                            <tr>
                                <td>{{ $need['company_name'] }}</td>
                                <td>{{ $need['date_of_filing'] }}</td>
                                <td>{{ $need['valid_until'] }}</td>
                                <td>{{ $need['phone_number'] }}</td>
                                <td class="text-center">
                                    <a class="btn btn-info btn-circle" href="{{ route('admin.network.show', $need['id']) }}" title="Detail"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.network.delete', $need['id']) }}" class="btn btn-circle btn-danger" onclick="event.preventDefault();
                                        document.getElementById('delete-donasi-form-{{$need['id']}}').submit();"><i class="fa fa-times"></i></a>
                                    <form action="{{ route('admin.network.delete', $need['id']) }}" id="delete-donasi-form-{{$need['id']}}" method="POST" style="display: none">
                                        <input type="hidden" name="_method" value="DELETE">
                                        @csrf
                                    </form>
                                </td>
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
