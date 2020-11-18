<?php

namespace App\Http\Controllers\Admin\CustomerService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MadingController extends Controller
{
    public function index(){
        return view('admin.cs.mading');
    }

    public function store(Request $request){

    }

    public function update(Request $request, $id){

    }

    public function delete($id){

    }
}
