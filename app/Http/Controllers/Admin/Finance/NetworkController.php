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
            'until' => ['required', 'date', 'after:created']
        ]);
    }

    public function store(Request $request){
        $validator = $this->networkValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.network.index')->with('Error', $validator->errors());
        }

        $files = [];
        if ($request->comp != null){
            $path = $this->savePhoto($request, 'comp');
            $arr = [
                'Content-Type' => 'multipart/form-data',
                'name' => 'company_images[0]',
                'contents' => fopen($path, 'r')
            ];
            array_push($files, $arr);
        }
        if ($request->product0 != null){
            $path = $this->savePhoto($request, 'product0');
            $arr = [
                'Content-Type' => 'multipart/form-data',
                'name' => 'product_images[0]',
                'contents' => fopen($path, 'r')
            ];
            array_push($files, $arr);
        }
        if ($request->product1 != null){
            $path = $this->savePhoto($request, 'product1');
            $arr = [
                'Content-Type' => 'multipart/form-data',
                'name' => 'product_images[1]',
                'contents' => fopen($path, 'r')
            ];
            array_push($files, $arr);
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->createNeed(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => 'company_name',
                    'contents' => $request->name,
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
                    'name' => 'date_of_filing',
                    'contents' => $request->created,
                ],
                [
                    'name' => 'valid_until',
                    'contents' => $request->until,
                ],
                $files
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.network.index')->with('Success', 'Network berhasil dibuat');
        }
        return redirect()->route('admin.network.index')->with('Fail', $content['message']);
    }

    public function show($id){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readNeed(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'form_params' => [
                'id_need' => $id
            ]
        ])->getBody();
        $content = json_decode($response, true);

        return view('admin.network.show', [
            'network' => $content['data']
        ]);
    }

    public function update(Request $request, $id){
        $validator = $this->networkValidator($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.network.index')->with('Error', $validator->errors());
        }

        $files = [];
        if ($request->comp != null){
            $path = $this->savePhoto($request, 'comp', $request->comp);
            $arr = [
                'Content-Type' => 'multipart/form-data',
                'name' => 'company_images[0]',
                'contents' => fopen($path, 'r')
            ];
            array($files, $arr);
        }
        if ($request->product0 != null){
            $path = $this->savePhoto($request, 'product0', $request->product0);
            $arr = [
                'Content-Type' => 'multipart/form-data',
                'name' => 'product_images[0]',
                'contents' => fopen($path, 'r')
            ];
            array($files, $arr);
        }
        if ($request->product1 != null){
            $path = $this->savePhoto($request, 'product1', $request->product1);
            $arr = [
                'Content-Type' => 'multipart/form-data',
                'name' => 'product_images[1]',
                'contents' => fopen($path, 'r')
            ];
            array($files, $arr);
        }

        $client = new Client();
        $response = $client->post((new OwlixApi())->updateNeed(), [
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
                    'name' => 'address',
                    'contents' => $request->address,
                ],
                [
                    'name' => 'price_request',
                    'contents' => $request->price,
                ],
                [
                    'name' => 'date_of_filing',
                    'contents' => $request->created,
                ],
                [
                    'name' => 'valid_until',
                    'contents' => $request->until,
                ],
                $files
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.network.index')->with('Success', 'Network berhasil diubah');
        }
        return redirect()->route('admin.network.index')->with('Fail', $content['message']);
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
