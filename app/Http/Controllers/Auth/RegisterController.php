<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use GrahamCampbell\ResultType\Success;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }

    private function registerValidator(array $data){
        return Validator::make($data, [
            'full_name' => ['required'],
            'email' => ['email', 'required'],
            'password' => ['required'],
            'confirm_password' => ['required', 'same:password']
        ]);
    }

    public function register(Request $request){
        $validator = $this->registerValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('auth.showRegister')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post($this->apiLink->register(), [
            'headers' =>[
                'Accept' => 'application/json'
            ],
            'form_params' => [
                'name' => $request->full_name,
                'email' => $request->email,
                'password' => $request->password,
                'c_password' => $request->confirm_password
            ]
        ]);

        $content =  json_decode($response->getBody(), true);

        if (strtolower($content['status']) == 'success'){
            $this->setApiKey($content['data']['token']);
            return redirect()->route('admin.home');
        }

        return redirect()->route('auth.showRegister')->with('Fail', $content['message']);
    }
}
