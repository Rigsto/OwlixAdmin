@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Detail Order</h1>
        </div>
        <div class="card shadow mb-3">
            <div class="card-header">
                <h1 class="h4 mb-0 font-weight-bold text-primary">Informasi Order</h1>
            </div>
            <div class="card-body">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="font-weight-bold mb-1">No. Invoice</div>
                        <div class="h5 mb-0 text-gray-800">{{ $order['external_id'] }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="font-weight-bold mb-1">Tanggal</div>
                        <div class="h5 mb-0 text-gray-800">{{ \Carbon\Carbon::parse($order['created_at'])->setTimezone('Asia/Jakarta')->toDayDateTimeString()  }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="font-weight-bold mb-1">Alamat Pengiriman</div>
                        <div class="h5 mb-0 text-gray-800">{{ $order['customer']['address'].", ".$city." ".$order['customer']['postal_code'].", ".$province}}</div>
                    </div>
                </div>
                <div class="row no-gutters pt-3">
                    <div class="col-md-4">
                        <div class="font-weight-bold mb-1">Informasi Pembeli</div>
                        <ul class="mb-4 p-0">
                            <li class="text-gray-800 list-unstyled h5 mb-0">{{$order['customer']['name']}}</li>
                            <li class="text-gray-800 list-unstyled h5 mb-0">{{$order['customer']['email']}}</li>
                            <li class="text-gray-800 list-unstyled h5 mb-0">{{$order['customer']['phone_number']}}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="font-weight-bold mb-1">Metode Pembayaran</div>
                        <div class="h5 mb-0 text-gray-800">-</div>
                    </div>
                    <div class="col-md-4">
                        <div class="font-weight-bold mb-1">Status Pembayaran</div>
                        @if($order['status'] == 'NEW')
                            <div class="text-uppercase text-warning font-weight-bold h5 mb-0">Menunggu Pembayaran</div>
                        @elseif($order['status'] == 'PAID')
                            <div class="text-uppercase text-success font-weight-bold h5 mb-0">Diterima</div>
                        @elseif($order['status'] == 'REJECTED')
                            <div class="text-uppercase text-danger font-weight-bold h5 mb-0">Dibatalkan</div>
                        @elseif($order['status'] == 'SHIPPING')
                            <div class="text-uppercase text-primary font-weight-bold h5 mb-0">Dikirim</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @foreach($stores as $store)
            @php
            $data = [];
            foreach ($order['order_items'] as $item){
                if ($item['store_item']['id_store'] == $store['0']['id']){
                    array_push($data, $item);
                }
            }
            @endphp
            @if(count($data) > 0)
                <div class="card shadow mb-3">
                    <div class="card-header">
                        <h1 class="h4 mb-0 font-weight-bold text-primary">{{$store['0']['name']}}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row no-gutters mb-3">
                            <div class="col-md-4">
                                <div class="font-weight-bold mb-1">Email</div>
                                <div class="h5 mb-0 text-gray-800">{{$store['0']['email']}}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="font-weight-bold mb-1">Np. HP</div>
                                <div class="h5 mb-0 text-gray-800">{{$store['0']['phone_number']}}</div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center">Jumlah</th>
                                        <th>Harga</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-800">
                                @foreach($data as $d)
                                <tr>
                                    <td>{{$d['store_item']['name']}}</td>
                                    <td class="text-center">{{$d['quantity']}}</td>
                                    <td>Rp. {{ number_format($d['store_item']['store_item_price'], 0, "", ".") }}</td>
                                    <td>Rp. {{ number_format($d['store_item']['store_item_price']*$d['quantity'], 0, "", ".") }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="card shadow mb-3">
            <div class="card-header">
                <h1 class="h4 mb-0 font-weight-bold text-primary">Informasi Pembayaran</h1>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="font-weight-bold">Sub Total</td>
                            <td>Rp. {{ number_format($order['amount'], 0, "", ".") }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Biaya Pengiriman</td>
                            <td>Rp. {{ number_format($order['delivery_expense'], 0, "", ".") }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Biaya Admin</td>
                            <td>Rp. {{ number_format(0, 0, "", ".") }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold h4">Total</td>
                            <td class="h4">Rp. {{ number_format($order['amount']+$order['delivery_expense'], 0, "", ".") }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
