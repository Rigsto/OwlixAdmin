<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseDashboardController extends Controller
{
    public function getUserPartner(){
        return $this->getUsers('Partner');
    }

    public function getUserStore(){
        return $this->getUsers('Store');
    }

    public function getUserCustomer(){
        return $this->getUsers('Customer');
    }

    private function getUsers($zone){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getAllUser(), [
             'headers' => [
                 'Authorization' => 'Bearer '.Auth::user()->token,
             ],
            'query' => [
                'zone' => $zone
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return $content['data'];
        }
        return [];
    }

    public function getOrders(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getAllOrder(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return $content['data'];
        }
        return [];
    }

    public function getDonations(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->getTotalDonation(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return $content['data'];
    }

    public function getNeeds(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readNeed(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return $content['data'];
    }
}
