@extends('layouts.app')
@section('styles')
    <style>
        input::-webkit-inner-spin-button,
        input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Tambah Owlix Network</h1>
        </div>
        <form action="{{ route('admin.network.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card shadow mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h1 class="h4 mb-0 font-weight-bold text-primary">Informasi Umum</h1>
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="name" class="text-gray-800">Nama Perusahaan</label>
                            {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="address" class="text-gray-800">Alamat</label>
                            {!! Form::text('address', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="price" class="text-gray-800">Harga Permintaan</label>
                            {!! Form::number('price', null, ['class'=>'form-control', 'min'=>0]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="created" class="text-gray-800">Tanggal Pengajuan</label>
                            {!! Form::date('created', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="until" class="text-gray-800">Berlaku Hingga</label>
                            {!! Form::date('until', \Carbon\Carbon::now(), ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-header">
                    <h1 class="h4 mb-0 font-weight-bold text-primary">Dokumentasi</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 form-group text-center">
                            <label for="comp" class="text-gray-800">Profil Perusahaan</label><br>
                            <img src="{{ asset('img/300x300.png') }}" alt="" style="width: 300px" class="mb-2" id="comp">
                            {!! Form::file('comp', ['class'=>'form-control-file']) !!}
                        </div>
                        <div class="col-md-4 form-group text-center">
                            <label for="product0" class="text-gray-800">Foto Produk 1</label><br>
                            <img src="{{ asset('img/300x300.png') }}" alt="" style="width: 300px" class="mb-2" id="prod0">
                            {!! Form::file('product0', ['class'=>'form-control-file']) !!}
                        </div>
                        <div class="col-md-4 form-group text-center">
                            <label for="product1" class="text-gray-800">Foto Produk 2</label><br>
                            <img src="{{ asset('img/300x300.png') }}" alt="" style="width: 300px" class="mb-2" id="prod1">
                            {!! Form::file('product1', ['class'=>'form-control-file']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $("input[name='comp']").change(function() {readURL(this, '#comp');});
        $("input[name='product0']").change(function() {readURL(this, '#prod0')})
        $("input[name='product1']").change(function () {readURL(this, '#prod1')})

        function readURL(input, output){
            if (input.files && input.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                    $(output).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
