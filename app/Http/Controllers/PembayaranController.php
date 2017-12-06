<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Pembayaran;
use App\Invoice;
use App\PerformanceBudget;

use Datatables;

class PembayaranController extends Controller
{
    function __construct($foo = null)
    {
        $this->middleware('auth');
        $this->data = array();
    }

    public function getDatatables()
    {
        return Datatables::of(Pembayaran::query())
        ->addColumn('action', function ($data) {
                $btn_action = '<a href="'.url('pembayaran/edit/'.$data->id).'" class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';
                $btn_action .= '<a href="javascript:void(0);" onclick="return confirmDelete('.$data->id.',\''.$data->kepada.'\')" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> &nbsp;';
                // $btn_action .= '<a href="'.url('pembayaran/detail/'.$data->id).'" class="btn btn-xs btn-success" title="Detail"><i class="glyphicon glyphicon-search"></i></a>';
                return $btn_action;
        })->editColumn('invoice_id', function(Pembayaran $data){
            return $data->getDetail();
        })->editColumn('jumlah', function(Pembayaran $data){
            return "Rp " . number_format($data->jumlah,0,',','.');
        })->make(true);
    }

    public function getPembayaran()
    {
        return view('pembayaran');
    }

    public function getAdd(Request $request, $id=null)
    {
        $this->data['invoice'] = Invoice::all();
        $this->data['pb'] = PerformanceBudget::all();
        $this->data['pembayaran'] = $id ? Pembayaran::find($id) : new Pembayaran;

        return view('pembayaran_form', $this->data);
    }

    public function doAdd(Request $request, $id=null)
    {
        $this->validate($request, [
                'jenis' => 'required',
                'pembayaran_date' => 'required',
                'jumlah' => 'required',
            ]);

        $pembayaran = empty($id) ? new Pembayaran : Pembayaran::findOrFail($id);
        $pembayaran->jenis = $request->input('jenis');
        
        if ($request->input('invoice_id')) {
            $pembayaran->invoice_id = $request->input('invoice_id');
            $pembayaran->pb_id = $pembayaran->getPbId()->id;
            
        } else {
            $pembayaran->pb_id = $request->input('pb_id');            
        }

        $pembayaran->pembayaran_date = date('Y-m-d H:i:s', strtotime($request->input('pembayaran_date')));
        $pembayaran->keterangan = $request->input('keterangan');

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('jumlah'), $trans);

        $pembayaran->jumlah = floatval($value);  
        $pembayaran->save();

        return redirect('pembayaran');
    }

    public function doDelete(Request $request, $id=null)
    {
        if($id)
        {
            $pembayaran = Pembayaran::findOrFail($id);
            $pembayaran->delete();

            $notif = 'Delete data success!';
            return redirect('pembayaran'); 
        }       

    }

}
