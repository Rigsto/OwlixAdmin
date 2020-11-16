<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    private function loginValidator(array $data){
        return Validator::make($data, [
            'email' => ['required'],
            'password' => ['required']
        ]);
    }

    public function login(Request $request){
        $validator = $this->loginValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('auth.showLogin')->with('Error', $validator->errors());
        }

        $client = new Client();
        $result = $client->post($this->apiLink->login(), [
            'form-params' => [
                'email' => $request->email,
                'password' => $request->password
            ]
        ]);

        return $result->getBody()->getContents();
    }

    public function logout(Request $request){
        $client = new Client();
        $response = $client->get($this->apiLink->logout(), [

        ]);
    }
}
