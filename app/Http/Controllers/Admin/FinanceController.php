<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function omset(){
        return view('admin.finance.omsetowlix');
    }

    public function getAllPenarikanSaldo(){
        return view('admin.finance.penarikansaldo');
    }

    public function getAllPengembalianSaldo(){
        return view('admin.finance.pengembaliansaldo');
    }

    public function subscribe(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getAllUser(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'query' => [
                'zone' => 'Partner'
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.finance.subscribe', [
            'datas' => $content['data']['0'] ?? []
        ]);
    }
}
