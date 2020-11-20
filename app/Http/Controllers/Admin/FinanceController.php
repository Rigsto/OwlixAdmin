<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function omset(){
        return view('admin.finance.omsetowlix');
    }

    public function getAllDonasi(){
        return view('admin.finance.donasi.index');
    }

    public function addDonasi(){

    }

    public function getDonasi($id){
        return view('admin.finance.donasi.show');
    }

    public function deleteDonasi($id){

    }

    public function getAllPenarikanSaldo(){
        return view('admin.finance.penarikansaldo');
    }

    public function getAllPengembalianSaldo(){
        return view('admin.finance.pengembaliansaldo');
    }

    public function subscribe(){
        return view('admin.finance.subscribe');
    }
}
