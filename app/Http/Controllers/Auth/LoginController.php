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
        if (Auth::check()){
            return redirect()->route('admin.home');
        }

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
        $response = $client->post((new OwlixApi())->login(), [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password
            ]
        ]);

        $content =  json_decode($response->getBody(), true);

        if ($content['status'] == 'success'){
            $this->updateToken($content['data']['token'], $request->email);

            return redirect()->route('admin.home');
        } else if ($content['status'] == 'failed') {
            return redirect()->route('auth.showLogin')->with('Fail', $content['message']);
        }

        return redirect()->route('auth.showLogin')->with('Fail', 'Wrong Email or Password');
    }

    private function updateToken($token, $email){
        $users = User::where('email', $email)->get();

        if (count($users) == 1){
            $user = $users->first();
            $user->update([
                'token' => $token
            ]);
        } else {
            $user = User::create([
                'email' => $email,
                'token' => $token
            ]);
        }

        Auth::loginUsingId($user->id);
    }

    public function logout(Request $request){
        $client = new Client();
        $response = $client->get((new OwlixApi())->logout(), [

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
