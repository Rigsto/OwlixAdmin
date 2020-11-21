<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonasiController extends Controller
{
    public function getOrphans(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readOrphanages(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ]
        ])->getBody();
        $content = json_decode($response, true);

        return view('admin.finance.donasi.index', [
            'orphans' => $content['data'] ?? []
        ]);
    }

    public function getDonasi($id){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readDonation(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ]
        ])->getBody();
        $content = json_decode($response, true);

        return view('admin.finance.donasi.show', [
            'donations' => $content['data'] ?? []
        ]);
    }

    private function orphansValidator(array $data){
        return Validator::make($data, [
            'name' => ['required'],
            'address' => ['required'],
            'hp' => ['required'],
            'admin' => ['required']
        ]);
    }

    public function addOrphans(Request $request){
        $validator = $this->orphansValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.donasi.index')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createOrphanage(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token
            ],
            'form_params' => [
                'orphanage_name' => $request->name,
                'orphanage_address' => $request->address,
                'orphanage_phone_number' => $request->hp,
                'orphanage_administrator' => $request->admin,
            ]
        ])->getBody();
        $content = json_decode($response, true);

        if ($content['success'] == 'success'){
            return redirect()->route('admin.donasi.index')->with('Success', 'Data Panti Asuhan berhasil ditambahkan');
        }
        return redirect()->route('admin.donasi.index')->with('Fail', $content['message']);
    }

    public function updateOrphans(Request $request, $id){
        $validator = $this->orphansValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.donasi.index')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->patch((new OwlixApi())->updateOrphanage(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token
            ],
            'form_params' => [
                'id_orphanage' => $id,
                'orphanage_name' => $request->name,
                'orphanage_address' => $request->address,
                'orphanage_phone_number' => $request->hp,
                'orphanage_administrator' => $request->admin,
            ]
        ])->getBody();
        $content = json_decode($response, true);

        if ($content['success'] == 'success'){
            return redirect()->route('admin.donasi.index')->with('Success', 'Data Panti Asuhan berhasil diubah');
        }
        return redirect()->route('admin.donasi.index')->with('Fail', $content['message']);
    }

    public function deleteOrphans($id){
        $client = new Client();
        $response = $client->delete((new OwlixApi())->deleteOrphanage(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token
            ],
            'form_params' => [
                'id_orphanage' => $id,
            ]
        ])->getBody();
        $content = json_decode($response, true);

        if ($content['success'] == 'success'){
            return redirect()->route('admin.donasi.index')->with('Success', 'Data Panti Asuhan berhasil diubah');
        }
        return redirect()->route('admin.donasi.index')->with('Fail', $content['message']);
    }
}
