<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PerformanceBudget;
use App\Pembayaran;

use Datatables;
use PDF;

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
        $this->data['realisasi'] = (new Pembayaran)->getRealisasi($id);
        // $this->data['pembayaran'] = Pembayaran::where('pb_id', $id)->get();

        // dd($this->data['realisasi']);
        return view('realisasi_form', $this->data);
    } 

    public function downloadPdf(Request $request, $id=null, $view=true)
    {
        $this->data['pb'] = PerformanceBudget::findOrFail($id);
        $this->data['realisasi'] = (new Pembayaran)->getRealisasi($id);

        if ($view) {
            return view('print.realisasi', $this->data);
        }

        // ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $pdf = PDF::loadView('print.realisasi', $this->data);
        return $pdf->stream('PerformanceBudget-'.$this->data['pb']->client_name.'.pdf');
    }

}
