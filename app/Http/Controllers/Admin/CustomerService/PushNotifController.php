<?php

namespace App\Http\Controllers\Admin\CustomerService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PushNotifController extends Controller
{
    public function index(){
        return view('admin.cs.pushnotif');
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }

    public function delete($id){

    }
}
