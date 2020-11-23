<?php

namespace App\Http\Controllers\Admin\CustomerService;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PushNotifController extends Controller
{
    public function index(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readAllPushNotif(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.cs.pushnotif', [
            'datas' => $content['data'] ?? []
        ]);
    }

    private function dataValidation(array $data){
        return Validator::make($data, [
            'title' => ['required'],
            'body' => ['required']
        ]);
    }

    public function store(Request $request){
        $validator = $this->dataValidation($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.notif')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createPushNotif(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'title' => $request->title,
                'body' => $request->body
            ]
        ])->getBody();
        $content = json_decode($response, true);

        if ($content['status'] == 'success'){
            return redirect()->route('admin.notif')->with('Success', 'Push Notification berhasil ditambahkan');
        }
        return redirect()->route('admin.notif')->with('Fail', $content['message']);
    }
}
