<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use GrahamCampbell\ResultType\Success;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct(){
        $this->middleware('guest');
    }

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

    protected function create(array $data, $token)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'token' => $token
        ]);
    }

    public function register(Request $request){
        $validator = $this->registerValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('auth.showRegister')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->register(), [
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
            $this->create($request->all(), $content['data']['token']);

            return redirect()->route('auth.showLogin')->with('Success', 'Register Successful, Please Login!');
        }

        return redirect()->route('auth.showRegister')->with('Fail', $content['message']);
    }
}
