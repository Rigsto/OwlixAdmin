<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Main\BaseDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseDashboardController
{
    public function home(){
        return view('admin.dashboard', [
            'totalPartner' => count($this->getUserPartner()),
            'totalStore' => count($this->getUserStore()),
            'totalCustomer' => count($this->getUserCustomer()),
            'totalOrder' => count($this->getOrders()),
            'totalDonation' => $this->getDonations(),
        ]);
    }

    public function userZone($id){
        switch ($id){
            case 1:
                return view('admin.dashboard.userzone1', [
                    'users' => $this->getUserPartner()
                ]);
            case 2:
                return view('admin.dashboard.userzone2', [
                    'users' => $this->getUserStore()
                ]);
            case 3:
                return view('admin.dashboard.userzone3', [
                    'users' => $this->getUserCustomer()
                ]);
        }
        return redirect()->route('admin.home');
    }
}
