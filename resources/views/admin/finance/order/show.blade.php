@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @include('layouts.alert')
        <div class="d-sm-flex align-items center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">Detail Order</h1>
        </div>
        <div class="card shadow mb-8">
            <div class="card-body">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">No. Invoice</div>
                        <div class="h5 mb-0 text-gray-800">{{ $order['external_id'] }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Tanggal</div>
                        <div class="h5 mb-0 text-gray-800">{{ \Carbon\Carbon::parse($order['created_at'])->setTimezone('Asia/Jakarta')->toDayDateTimeString()  }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Alamat Pengiriman</div>
                        <div class="h5 mb-0 text-gray-800">{{ $order['customer']['address'].", ".$order['customer']['city_id']." ".$order['customer']['postal_code'].", ".$order['customer']['province_id']}}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Nama Mitra</div>
                        <div class="h5 mb-0 text-gray-800">Frozen Food Wiyung</div>
                    </div>
                </div>
                <div class="row no-gutters py-3">
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Informasi Pembeli</div>
                        <ul class="mb-4 p-0">
                            <li class="text-gray-800 list-unstyled h5 mb-0">Sekar Arum</li>
                            <li class="text-gray-800 list-unstyled h5 mb-0">sekararum@gmail.com</li>
                            <li class="text-gray-800 list-unstyled h5 mb-0">0821142425552</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Metode Pembayaran</div>
                        <div class="h5 mb-0 text-gray-800">Bank Transfer<br>BCA / 021074187486 / PT. Berkat Mas Indonesia</div>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Status Pembayaran</div>
                        <div class="h5 mb-0 text-gray-800">Diterima</div>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Nama Reseller</div>
                        <div class="h5 mb-0 text-gray-800">Hendy Shop</div>
                    </div>
                </div>
                <div class="row no-gutters py-3">
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">Ekspedisi</div>
                        <div class="h5 mb-0 text-gray-800">JNE Reguler</div>
                    </div>
                    <div class="col-md-3">
                        <div class="font-weight-bold mb-1">No. Resi</div>
                        <div class="h5 mb-0 text-gray-800">-</div>
                    </div>
                    <div class="col-md-3 offset-md-3">
                        <div class="font-weight-bold mb-1">Voucher</div>
                        <div class="h5 mb-0 text-gray-800">Kode Voucher</div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead class="thead-dark">
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Pengiriman</th>
                            <th>Harga</th>
                            <th>Sub Total</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-800">
                        <tr>
                            <td>Frozen Food isi 20 pcs</td>
                            <td class="text-center">2</td>
                            <td class="text-center">JNE Reguler</td>
                            <td>Rp. 10.000</td>
                            <td>Rp. 20.000</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td class="font-weight-bold">Sub Total</td>
                            <td>Rp. 20.000</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td class="font-weight-bold">Biaya Pengiriman</td>
                            <td>Rp. 10.000</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td class="font-weight-bold">Voucher</td>
                            <td>Rp. 0</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td class="font-weight-bold">Biaya Admin</td>
                            <td>Rp. 2.500</td>
                        </tr>
                        <tr>
                            <td></td><td></td><td></td>
                            <td class="font-weight-bold h4">Total</td>
                            <td class="h4">Rp. 32.500</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
