<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PerformanceBudget;
use App\Pembayaran;

use Datatables;

class RealisasiController extends Controller
{
    function __construct($foo = null)
    {
        $this->middleware('auth');
        $this->data = array();
    }

    public function getDatatables()
    {
        return Datatables::of(PerformanceBudget::query())
        ->addColumn('action', function ($data) {
            $btn_action = '<a href="'.url('realisasi/detail/'.$data->id).'" class="btn btn-xs btn-success" title="Lihat realisasi"><i class="glyphicon glyphicon-search"></i></a>';
            return $btn_action;
        })->editColumn('value', function(PerformanceBudget $data){
            return "Rp " . number_format($data->value,0,',','.');
        })->editColumn('contract_date', function(PerformanceBudget $data){
            return date('d M Y', strtotime($data->contract_date));
        })->make(true);
    }

    public function getPerformanceBudget()
    {
        return view('realisasi');
    }

    public function getDetail(Request $request, $id=null)
    {
        $this->data['pb'] = PerformanceBudget::findOrFail($id);
        $this->data['pembayaran'] = Pembayaran::where('pb_id', $id)->get();
        return view('realisasi_form', $this->data);
    } 

}
