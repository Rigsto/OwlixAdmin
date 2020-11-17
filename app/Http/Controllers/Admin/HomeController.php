<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){
        return view('admin.dashboard');
    }

    public function userZone($id){
        switch ($id){
            case 1:
                return view('admin.dashboard.userzone1');
            case 2:
                return view('admin.dashboard.userzone2');
            case 3:
                return view('admin.dashboard.userzone3');
        }
        return redirect()->route('admin.home');
    }
}
