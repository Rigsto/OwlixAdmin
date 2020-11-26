@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Pengajuan Voucher</h1>
            <button type="button" class="btn btn-primary" title="Tambah Voucher" data-toggle="modal" data-target="#createVoucher">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah
            </button>
            @include('modal.create_voucher')
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Diskon</th>
                            <th>Berlaku hingga</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        @foreach($vouchers as $voucher)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($voucher['created_at'])->setTimezone('Asia/Jakarta')->toFormattedDateString() }}</td>
                            <td>{{ $voucher['discount'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($voucher['expired_date'])->setTimezone('Asia/Jakarta')->toFormattedDateString()}}</td>
                            @if($voucher['is_active'])
                                <td class="text-success font-weight-bold text-uppercase">Aktif</td>
                            @else
                                <td class="text-danger font-weight-bold text-uppercase">Tidak Aktif</td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-warning btn-circle" title="Edit" data-toggle="modal" data-target="#updateVoucher-{{$voucher['id']}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <a href="{{ route('admin.voucher.delete', $voucher['id']) }}" class="btn btn-circle btn-danger" onclick="event.preventDefault();
                                            document.getElementById('delete-voucher-form-{{$voucher['id']}}').submit();"><i class="fa fa-times"></i></a>
                                <form action="{{ route('admin.voucher.delete', $voucher['id']) }}" id="delete-voucher-form-{{$voucher['id']}}" method="POST" style="display: none">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                </form>
                            </td>
                            @include('modal.edit_voucher')
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
