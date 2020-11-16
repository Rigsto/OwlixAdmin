<?php

namespace App\Http\Controllers;

use App\Models\OwlixApi;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $apiKey;
    protected $apiLink;

    public function __construct(){
        $this->apiLink = new OwlixApi();
    }

    public function setApiKey($key){
        $this->apiKey = $key;
    }
}
