<?php

namespace App\Http\Controllers\Admin\CustomerService;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PushNotifController extends Controller
{
    public function index(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readAllPushNotif(), [
            'headers' => [
                'Authorization' => Auth::user()->token,
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.cs.pushnotif', [
            'datas' => $content['data']
        ]);
    }

    public function store(Request $request){

    }
}
