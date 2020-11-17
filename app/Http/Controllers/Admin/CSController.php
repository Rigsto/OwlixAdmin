<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CSController extends Controller
{
    public function category(){
        $client = new Client();
        $partner = $client->get((new OwlixApi())->readPartnerCategories(), [
             'headers' => [
                 'Authorization' => 'Bearer '.Auth::user()->token,
             ]
        ])->getBody();

        $item = $client->get((new OwlixApi())->readItemCategories(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ]
        ])->getBody();

        $p = json_decode($partner, true);
        $i = json_decode($item, true);

        if ($p['status'] == 'success' && $i['status'] == 'success'){
            return view('admin.cs.category', [
                'partners' => $p['data'],
                'items' => $i['data']
            ]);
        }
        return view('admin.cs.category', [
            'partners' => [],
            'items' => []
        ]);
    }

    private function categoryValidator(array $data){
        return Validator::make($data, [
            'name' => ['required'],
            'status' => ['numeric']
        ]);
    }

    public function storeCategoryToko(Request $request){
        $validator = $this->categoryValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.categories')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createPartnerCategory(), [
             'headers' => [
                 'Authorization' => 'Bearer '.Auth::user()->token,
             ],
            'form_params' => [
                'name' => $request->name
            ]
        ])->getBody();

        $res = json_decode($response, true);

        if ($res['status'] == 'success'){
            return redirect()->route('admin.categories')->with('Success', 'Kategori Toko berhasil ditambahkan.');
        }
        return redirect()->route('admin.categories')->with('Fail', $res['message']);
    }

    public function storeCategoryItem(Request $request){
        $validator = $this->categoryValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.categories')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createItemCategory(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'name' => $request->name
            ]
        ])->getBody();

        $res = json_decode($response, true);

        if ($res['status'] == 'success'){
            return redirect()->route('admin.categories')->with('Success', 'Kategori Produk berhasil ditambahkan.');
        }
        return redirect()->route('admin.categories')->with('Fail', $res['message']);
    }

    public function updateCategoryToko(Request $request, $id){

    }

    public function updateCategoryItem(Request $request, $id){

    }

    public function deleteCategoryToko($id){
        $client = new Client();
        $response = $client->delete((new OwlixApi())->deletePartnerCategories(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'id' => $id
            ]
        ])->getBody();

        $res = json_decode($response, true);

        if ($res['status'] == 'success'){
            return redirect()->route('admin.categories')->with('Success', 'Kategori Toko berhasil dihapus.');
        }
        return redirect()->route('admin.categories')->with('Fail', $res['message']);
    }

    public function deleteCategoryItem($id){
        $client = new Client();
        $response = $client->delete((new OwlixApi())->deleteItemCategory(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'id' => $id
            ]
        ])->getBody();

        $res = json_decode($response, true);

        if ($res['status'] == 'success'){
            return redirect()->route('admin.categories')->with('Success', 'Kategori Produk berhasil dihapus.');
        }
        return redirect()->route('admin.categories')->with('Fail', $res['message']);
    }
}
