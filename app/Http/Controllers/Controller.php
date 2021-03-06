<?php

namespace App\Http\Controllers;

use App\Models\OwlixApi;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getProvince($province_id){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readProvince())->getBody();
        $content = json_decode($response, true);

        if ($content['status'] == 'success'){
            foreach ($content['data'] as $data){
                if ($data['province_id'] == $province_id){
                    return $data['province'];
                }
            }
        }
        return "";
    }

    public function getCity($province_id, $city_id){
        $client = new Client();
        $response = $client->get((new OwlixApi())->readCity(), [
            'query' => [
                'province_id' => $province_id
            ]
        ])->getBody();
        $content = json_decode($response, true);

        if ($content['status'] == 'success'){
            foreach ($content['data'] as $data){
                if ($data['city_id'] == $city_id){
                    return $data['city_name'];
                }
            }
        }
        return "";
    }

    public function savePhoto(Request $request, $key){
        $file = $request->file($key);
        if ($file == null) return null;
        $name = time() . '_' . $file->getClientOriginalName();
        $path = base_path() .'/public/documents/';
        $resource = fopen($file,"r") or die("File upload Problems");
        $file->move($path, $name);
        return $path.$name;
    }
}
