<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NetworkController extends Controller
{
    public function index(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readNeed(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ]
        ])->getBody();
        $content = json_decode($response, true);

        return view('admin.finance.network.index', [
            'needs' => $content['data'] ?? []
        ]);
    }

    public function create(){
        return view('admin.finance.network.create');
    }

    private function networkValidator(array $data){
        return Validator::make($data, [
            'name' => ['required'],
            'address' => ['required'],
            'price' => ['required', 'min:0'],
            'created' => ['required', 'date'],
            'until' => ['required', 'date', 'after:created'],
            'title' => ['required'],
            'desc' => ['required'],
            'quantity' => ['required'],
            'phone' => ['required']
        ]);
    }

    public function store(Request $request){
        $validator = $this->networkValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.network.index')->with('Error', $validator->errors());
        }

        if ($request->product1 != null){
            $res = $this->storeWithProd1(
                $request,
                $this->savePhoto($request, 'comp'),
                $this->savePhoto($request, 'product0'),
                $this->savePhoto($request, 'product1'));
        } else {
            $res = $this->storeWithoutProd1(
                $request,
                $this->savePhoto($request, 'comp'),
                $this->savePhoto($request, 'product0'));
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createNeed(), $res)->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.network.index')->with('Success', 'Network berhasil dibuat');
        }
        return redirect()->route('admin.network.index')->with('Fail', $content['message']);
    }

    private function storeWithProd1($request, $pathComp, $pathProd0, $pathProd1){
        return [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => 'company_name',
                    'contents' => $request->name,
                ],
                [
                    'name' => 'title',
                    'contents' => $request->title,
                ],
                [
                    'name' => 'quantity',
                    'contents' => $request->quantity,
                ],
                [
                    'name' => 'description',
                    'contents' => $request->desc,
                ],
                [
                    'name' => 'address',
                    'contents' => $request->address,
                ],
                [
                    'name' => 'price_request',
                    'contents' => $request->price,
                ],
                [
                    'name' => 'phone_number',
                    'contents' => $request->phone
                ],
                [
                    'name' => 'date_of_filing',
                    'contents' => $request->created,
                ],
                [
                    'name' => 'valid_until',
                    'contents' => $request->until,
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'company_images[0]',
                    'contents' => fopen($pathComp, 'r')
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'product_images[0]',
                    'contents' => fopen($pathProd0, 'r')
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'product_images[1]',
                    'contents' => fopen($pathProd1, 'r')
                ]
            ]
        ];
    }

    private function storeWithoutProd1($request, $pathComp, $pathProd0){
        return [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => 'company_name',
                    'contents' => $request->name,
                ],
                [
                    'name' => 'title',
                    'contents' => $request->title,
                ],
                [
                    'name' => 'quantity',
                    'contents' => $request->quantity,
                ],
                [
                    'name' => 'description',
                    'contents' => $request->desc,
                ],
                [
                    'name' => 'address',
                    'contents' => $request->address,
                ],
                [
                    'name' => 'price_request',
                    'contents' => $request->price,
                ],
                [
                    'name' => 'phone_number',
                    'contents' => $request->phone
                ],
                [
                    'name' => 'date_of_filing',
                    'contents' => $request->created,
                ],
                [
                    'name' => 'valid_until',
                    'contents' => $request->until,
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'company_images[0]',
                    'contents' => fopen($pathComp, 'r')
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'product_images[0]',
                    'contents' => fopen($pathProd0, 'r')
                ],
            ]
        ];
    }

    public function show($id){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readNeed(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'query' => [
                'id_need' => $id
            ]
        ])->getBody();
        $content = json_decode($response, true);

        return view('admin.finance.network.show', [
            'network' => $content['data']
        ]);
    }

    public function update(Request $request, $id){
        $validator = $this->networkValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.network.index')->with('Error', $validator->errors());
        }

        if ($request->product1 != null){
            $res = $this->updateWithProd1(
                $request,
                $this->savePhoto($request, 'comp'),
                $this->savePhoto($request, 'product0'),
                $this->savePhoto($request, 'product1'),
                $id);
        } else {
            $res = $this->updateWithoutProd1(
                $request,
                $this->savePhoto($request, 'comp'),
                $this->savePhoto($request, 'product0'),
                $id);
        }

        $client = new Client();
        $response = $client->patch((new OwlixApi())->updateNeed(), $res)->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.network.index')->with('Success', 'Network berhasil diubah');
        }
        return redirect()->route('admin.network.index')->with('Fail', $content['message']);
    }

    private function updateWithProd1($request, $pathComp, $pathProd0, $pathProd1, $id){
        return [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => '_method',
                    'contents' => 'POST',
                ],
                [
                    'name' => 'id_need',
                    'contents' => $id
                ],
                [
                    'name' => 'company_name',
                    'contents' => $request->name,
                ],
                [
                    'name' => 'title',
                    'contents' => $request->title,
                ],
                [
                    'name' => 'quantity',
                    'contents' => $request->quantity,
                ],
                [
                    'name' => 'description',
                    'contents' => $request->desc,
                ],
                [
                    'name' => 'address',
                    'contents' => $request->address,
                ],
                [
                    'name' => 'price_request',
                    'contents' => $request->price,
                ],
                [
                    'name' => 'phone_number',
                    'contents' => $request->phone
                ],
                [
                    'name' => 'date_of_filing',
                    'contents' => $request->created,
                ],
                [
                    'name' => 'valid_until',
                    'contents' => $request->until,
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'company_images[0]',
                    'contents' => $pathComp != null ? fopen($pathComp, 'r') : null
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'product_images[0]',
                    'contents' => $pathProd0 != null ? fopen($pathProd0, 'r') : null
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'product_images[1]',
                    'contents' => $pathProd1 != null ? fopen($pathProd1, 'r') : null
                ]
            ]
        ];
    }

    private function updateWithoutProd1($request, $pathComp, $pathProd0, $id){
        return [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => 'id_need',
                    'contents' => $id
                ],
                [
                    'name' => 'company_name',
                    'contents' => $request->name,
                ],
                [
                    'name' => 'title',
                    'contents' => $request->title,
                ],
                [
                    'name' => 'quantity',
                    'contents' => $request->quantity,
                ],
                [
                    'name' => 'description',
                    'contents' => $request->desc,
                ],
                [
                    'name' => 'address',
                    'contents' => $request->address,
                ],
                [
                    'name' => 'price_request',
                    'contents' => $request->price,
                ],
                [
                    'name' => 'phone_number',
                    'contents' => $request->phone
                ],
                [
                    'name' => 'date_of_filing',
                    'contents' => $request->created,
                ],
                [
                    'name' => 'valid_until',
                    'contents' => $request->until,
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'company_images[0]',
                    'contents' => $pathComp != null ? fopen($pathComp, 'r') : null
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'product_images[0]',
                    'contents' => $pathProd0 != null ? fopen($pathProd0, 'r') : null
                ],
            ]
        ];
    }

    public function delete($id){
        $client = new Client();
        $response = $client->delete((new OwlixApi())->deleteNeed(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'id_need' => $id
            ]
        ])->getBody();
        $content = json_decode($response, true);

        if ($content['status'] == 'success'){
            return redirect()->route('admin.network.index')->with('Success', 'Network berhasil dihapus');
        }
        return redirect()->route('admin.network.index')->with('Fail', $content['message']);
    }
}
