<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    public function getAllVoucher(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readVouchers(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.finance.voucher', [
            'vouchers' => $content['data'] ?? []
        ]);
    }

    private function dataValidation(array $data){
        return Validator::make($data, [
            'discount' => ['required', 'min:0', 'max:100'],
            'expired' => ['required', 'date']
        ]);
    }

    public function storeVoucher(Request $request){
        $validator = $this->dataValidation($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.voucher')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createVoucher(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'discount' => $request->discount,
                'expired_date' => $request->expired
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.voucher')->with('Success', 'Voucher berhasil ditambahkan');
        }
        return redirect()->route('admin.voucher')->with('Fail', $content['message']);
    }

    public function updateVoucher(Request $request, $id){
        $validator = $this->dataValidation($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.voucher')->with('Error', $validator->errors());
        }

        $client = new Client();
        $response = $client->patch((new OwlixApi())->updateVoucher(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'discount' => $request->discount,
                'expired_at' => $request->expired
            ],
            'query' => [
                'id' => $id
            ]
        ]);

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.voucher')->with('Success', 'Voucher berhasil diubah');
        }
        return redirect()->route('admin.voucher')->with('Fail', $content['message']);
    }

    public function deleteVoucher($id){
        $client = new Client();
        $response = $client->delete((new OwlixApi())->deleteVoucher(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'id' => $id
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.voucher')->with('Success', 'Voucher berhasil dihapus');
        }
        return redirect()->route('admin.voucher')->with('Fail', $content['message']);
    }
}
