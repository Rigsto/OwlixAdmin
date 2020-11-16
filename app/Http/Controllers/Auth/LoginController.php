<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/home';

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

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

        $this->checkAccount($request);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $client = new Client();
            $response = $client->post((new OwlixApi())->login(), [
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password
                ]
            ]);

            $content =  json_decode($response->getBody(), true);

            if ($content['status'] == 'success'){
                Auth::user()->update([
                    'token' => $content['data']['token']
                ]);

                return redirect()->route('admin.home');
            }
        }

        return redirect()->route('auth.showLogin')->with('Fail', 'Wrong Email or Password');
    }

    public function checkAccount(Request $request){
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }
    }

    public function logout(Request $request){
        $client = new Client();
        $response = $client->get($this->apiLink->logout(), [

        ]);

        $content = json_decode($response->getBody(), true);

        if ($content['status'] == 'success'){
            Auth::user()->update([
                'token' => ''
            ]);
        }

        Auth::logout();
        return redirect()->route('auth.showLogin');
    }
}
