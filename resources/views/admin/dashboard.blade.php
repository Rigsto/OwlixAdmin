@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Dashboard</h1>
        </div>
{{--        {{ \Illuminate\Support\Facades\Auth::user()->token }}--}}
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-primary text-uppercase mb-1"><a href="{{ route('admin.zone', 1) }}">Jumlah User Aplikasi</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPartner }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-success text-uppercase mb-1"><a href="{{ route('admin.zone', 2) }}">Jumlah User Zona 2</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStore }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-info text-uppercase mb-1"><a href="{{ route('admin.zone', 3) }}">Jumlah User Zona 3</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomer }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-danger text-uppercase mb-1">Total Donasi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($totalDonation, 0, "", ".") }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-info text-uppercase mb-1">Jumlah Owlix Network</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">x20x</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-network-wired fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-primary text-uppercase mb-1">Jumlah Order</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrder }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items center">
                            <div class="col mr-2">
                                <div class="small font-weight-bold text-success text-uppercase mb-1">Total Omset Owlix</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">xRp. 100.000.000x</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
