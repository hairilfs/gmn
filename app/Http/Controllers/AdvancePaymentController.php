<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdvancePayment;
use App\PerformanceBudget;

use Datatables;

class AdvancePaymentController extends Controller
{
    function __construct($foo = null)
    {
        $this->middleware('auth');
        $this->data = array();
    }

    public function getDatatables()
    {
        return Datatables::of(AdvancePayment::query())
        ->addColumn('action', function ($data) {
            $btn_action = '<a href="'.url('advance_payment/edit/'.$data->id).'" class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> &nbsp;';
            $btn_action .= '<a href="javascript:void(0);" onclick="return confirmDelete('.$data->id.',\''.$data->kepada.'\')" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> &nbsp;';
            // $btn_action = '<a href="'.url('advance_payment/detail/'.$data->id).'" class="btn btn-xs btn-success" title="Lihat realisasi"><i class="glyphicon glyphicon-search"></i></a>';
            return $btn_action;
        })->editColumn('request', function(AdvancePayment $data){
            return "Rp " . number_format($data->request,0,',','.');
        })->editColumn('request_date', function(AdvancePayment $data){
            return date('d M Y', strtotime($data->request_date));
        })->editColumn('status', function(AdvancePayment $data){
            if ($data->confirm_date) {
                $status = '<span class="label bg-blue" title="'.date('d M Y', strtotime($data->confirm_date)).'">Confirmed</span>';
            } else {
                $status = '<span class="label bg-yellow">Unconfirmed</span>';
            }
            return $status;
        })->make(true);
    }

    public function getAdvancePayment()
    {
        return view('advance_payment');
    }

    public function getDetail(Request $request, $id=null)
    {
        $this->data['pb'] = PerformanceBudget::findOrFail($id);
        $this->data['pembayaran'] = Pembayaran::where('pb_id', $id)->get();
        return view('realisasi_form', $this->data);
    } 

    public function getAdd(Request $request, $id=null)
    {
        $this->data['pb'] = PerformanceBudget::all();
        $this->data['advance_payment'] = $id ? AdvancePayment::find($id) : new AdvancePayment;

        return view('advance_payment_form', $this->data);
    }

    public function doAdd(Request $request, $id=null)
    {
        $this->validate($request, [
                'pb_id' => 'required',
                'nip' => 'required',
                'request' => 'required',
                'request_date' => 'required',
            ]);

        $advance_payment = empty($id) ? new AdvancePayment : AdvancePayment::findOrFail($id);

        $advance_payment->pb_id         = $request->input('pb_id');
        $advance_payment->nip           = $request->input('nip');
        $advance_payment->nama          = $request->input('nama');
        $advance_payment->request_date  = date('Y-m-d H:i:s', strtotime($request->input('request_date')));
        $advance_payment->request_note  = $request->input('request_note');

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('request'), $trans);
        $advance_payment->request = floatval($value);

        $advance_payment->save();

        return redirect('advance_payment');
    }

    public function doConfirm(Request $request, $id=null)
    {
        $this->validate($request, [
                'confirm_date' => 'required',
                'confirm' => 'required',
            ]);

        $advance_payment = AdvancePayment::findOrFail($id);

        $advance_payment->confirm_note = $request->input('confirm_note');
        $advance_payment->confirm_date  = date('Y-m-d H:i:s', strtotime($request->input('confirm_date')));
        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('confirm'), $trans);
        $advance_payment->confirm = floatval($value);
        $advance_payment->save();

        return redirect('advance_payment');
    }

}
