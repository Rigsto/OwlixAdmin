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
        $response = $client->get((new OwlixApi())->readMading(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token
            ]
        ])->getBody();

        $content = json_decode($response, true);
        return view('admin.cs.mading', [
            'madings' => $content['data'] ?? [],
            'categories' => $this->getMadingCategories()
        ]);
    }

    private function madingValidation(array $data){
        return Validator::make($data, [
            'name' => ['required'],
            'kategori' => ['required'],
            'file' => ['mimes:jpeg,jpg,png', 'max:2048', 'required'],
            'status' => ['required']
        ]);
    }

    public function store(Request $request){
        $validator = $this->madingValidation($request->all());

        if ($validator->fails()) {
            return redirect()->route('admin.info')->with('Error', $validator->errors());
        }

        $pathname = $this->savePhoto($request, 'file');

        $client = new Client();
        $response = $client->post((new OwlixApi())->createMading(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => 'title',
                    'contents' => $request->name
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'image',
                    'contents' => fopen($pathname, 'r'),
                ],
                [
                    'name' => 'id_mading_category',
                    'contents' => $request->kategori
                ],
                [
                    'name' => 'is_active',
                    'contents' => $request->status == "1" ? "TRUE" : "FALSE"
                ],
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.info')->with('Success', 'Mading berhasil ditambahkan');
        }
        return redirect()->route('admin.info')->with('Fail', $content['message']);
    }

    private function updateMadingValidation(array $data){
        return Validator::make($data, [
            'name' => ['required'],
            'kategori' => ['required'],
            'status' => ['required']
        ]);
    }

    public function update(Request $request, $id){
        $validator = $this->updateMadingValidation($request->all());

        if ($validator->fails()){
            return redirect()->route('admin.info')->with('Error', $validator->errors());
        }

        $client = new Client();

        if ($request->file != null){
            $pathname = $this->savePhoto($request, 'file', $request->file);
            $response = $client->post((new OwlixApi())->updateMading(), $this->updateWithImage($request, $id, $pathname))->getBody();
        } else {
            $response = $client->post((new OwlixApi())->updateMading(), $this->updateWithoutImage($request, $id))->getBody();
        }

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.info')->with('Success', 'Mading berhasil diubah');
        }
        return redirect()->route('admin.info')->with('Fail', $content['message']);
    }

    private function updateWithImage(Request $request, $id, $name){
        return [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => 'title',
                    'contents' => $request->name
                ],
                [
                    'Content-Type' => 'multipart/form-data',
                    'name' => 'image',
                    'contents' => fopen($name, 'r'),
                ],
                [
                    'name' => 'id_mading_category',
                    'contents' => $request->kategori
                ],
                [
                    'name' => 'is_active',
                    'contents' => $request->status == "1" ? "TRUE" : "FALSE"
                ],
                [
                    'name' => 'id_mading',
                    'contents' => $id
                ],
                [
                    'name' => '_method',
                    'contents' => 'POST'
                ]
            ]
        ];
    }

    private function updateWithoutImage(Request $request, $id){
        return [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'multipart' => [
                [
                    'name' => 'title',
                    'contents' => $request->name
                ],
                [
                    'name' => 'id_mading_category',
                    'contents' => $request->kategori
                ],
                [
                    'name' => 'is_active',
                    'contents' => $request->status == "1" ? "TRUE" : "FALSE"
                ],
                [
                    'name' => 'id_mading',
                    'contents' => $id
                ],
                [
                    'name' => '_method',
                    'contents' => 'POST'
                ]
            ]
        ];
    }

    public function delete($id){
        $client = new Client();
        $response = $client->delete((new OwlixApi())->deleteMading(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
            'query' => [
                'id_mading' => $id
            ]
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            return redirect()->route('admin.info')->with('Success', 'Mading berhasil dihapus');
        }
        return redirect()->route('admin.info')->with('Fail', $content['message']);
    }

    public function getMadingCategories(){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readMadingCategory(), [
            'headers' => [
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
        ])->getBody();

        $content = json_decode($response, true);
        if ($content['status'] == 'success'){
            $arr = [];
            foreach ($content['data'] as $data){
                $arr[$data['id']] = $data['name'];
            }
            return $arr;
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
                'Authorization' => 'Bearer '.Auth::user()->token,
            ],
        ])->getBody();

        $content = json_decode($response, true);

    }
}
