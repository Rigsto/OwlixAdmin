<?php

namespace App\Http\Controllers\Admin\CustomerService;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MadingController extends Controller
{
    public function index(){
        $client = new Client();
        $response = $client->post((new OwlixApi())->readMading(), [
            'headers' => [
                'Authorization' => Auth::user()->token
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.cs.mading', [
            'madings' => $content['data'],
            'categories' => $this->getMadingCategories()
        ]);
    }

    private function madingValidation(array $data){
        return Validator::make($data, [
            'name' => ['required'],
            'kategori' => ['required'],
            'file' => ['mimes:jpeg,jpg,png', 'max:2048', 'required']
        ]);
    }

    public function store(Request $request){
        $validator = $this->madingValidation($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.info')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createMading(), [
            'headers' => [
                'Authorization' => Auth::user()->token
            ],
            'form_params' => [
                'title' => $request->name,
                'image' => $request->file,
                'id_mading_category' => $request->kategori
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.info')->with('Success', 'Mading berhasil ditambahkan');
        }
        return redirect()->route('admin.info')->with('Fail', $content['message']);
    }

    public function update(Request $request, $id){
        $validator = $this->madingValidation($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.info')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->updateMading(), [
            'headers' => [
                'Authorization' => Auth::user()->token
            ],
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.info')->with('Success', 'Mading berhasil ditambahkan');
        }
        return redirect()->route('admin.info')->with('Fail', $content['message']);
    }

    public function delete($id){
        $client = new Client();
        $response = $client->post((new OwlixApi())->deleteMading(), [
            'headers' => [
                'Authorization' => Auth::user()->token
            ],
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.info')->with('Success', 'Mading berhasil ditambahkan');
        }
        return redirect()->route('admin.info')->with('Fail', $content['message']);
    }

    public function getMadingCategories(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readMadingCategory(), [
            'headers' => [
                'Authorization' => Auth::user()->token,
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return $content['data'];
        }
        return [];
    }

    private function madingCategoryValidator(array $data){
        return Validator::make($data, [

        ]);
    }

    public function storeMadingCategories(Request $request){
        $validator = $this->madingCategoryValidator($request->all());

        if ($validator->fails()){

        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createMadingCategory(), [
            'headers' => [
                'Authorization' => Auth::user()->token
            ],
        ])->getBody();

        $content = json_decode($response, true);

    }
}
