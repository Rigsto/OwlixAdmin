<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getAllOrder(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getAllOrder(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.finance.order.index', [
            'orders' => $content['data'] ?? []
        ]);
    }

    public function getOrder($id){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getOrderDetail(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'query' => [
                'id_order' => $id
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.finance.order.show', [
            'order' => $content['data'],
            'stores' => $this->getUsers(),
            'province' => $this->getProvince($content['data']['customer']['province_id']),
            'city' => $this->getCity($content['data']['customer']['province_id'], $content['data']['customer']['city_id'])
        ]);
    }

    private function getUsers(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getAllUser(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'query' => [
                'zone' => 'Store'
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return $content['data'];
        }
        return [];
    }
}
