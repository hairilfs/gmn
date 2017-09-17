<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use App\PurchaseOrder;

use Datatables;

class InvoiceController extends Controller
{
    function __construct($foo = null)
    {
        $this->middleware('auth');
        $this->data = array();
    }

    public function getDatatables()
    {
        return Datatables::of(Invoice::query())
        ->addColumn('action', function ($data) {
                $btn_action = '<a href="'.url('invoice/edit/'.$data->id).'" class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> &nbsp;';
                $btn_action .= '<a href="javascript:void(0);" onclick="return confirmDelete('.$data->id.',\''.$data->kepada.'\')" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> &nbsp;';
                // $btn_action .= '<a href="'.url('invoice/detail/'.$data->id).'" class="btn btn-xs btn-success" title="Detail"><i class="glyphicon glyphicon-search"></i></a>';
                return $btn_action;
        })->editColumn('tipe', function(Invoice $data){
            $retVal = ($data->tipe) ? 'Pelunasan' : 'Uang Muka';
            return $retVal;
        })->editColumn('po_id', function(Invoice $data){
            return $data->getPo->kepada;
        })->editColumn('nominal', function(Invoice $data){
            return "Rp " . number_format($data->nominal,0,',','.');
        })->make(true);
    }

    public function getInvoice()
    {
        return view('invoice');
    }

    public function getAdd(Request $request, $id=null)
    {
        $this->data['po'] = PurchaseOrder::all();
        $this->data['invoice'] = $id ? Invoice::find($id) : new Invoice;

        return view('invoice_form', $this->data);
    }

    public function doAdd(Request $request, $id=null)
    {
        $this->validate($request, [
                'no_invoice' => 'required',
                'invoice_date' => 'required',
                'nominal' => 'required',
                'tipe' => 'required',
            ]);

        $invoice = empty($id) ? new Invoice : Invoice::findOrFail($id);

        $invoice->po_id         = $request->input('purchase_order_id');
        $invoice->no_invoice    = $request->input('no_invoice');
        $invoice->invoice_date  = date('Y-m-d H:i:s', strtotime($request->input('invoice_date')));
        $invoice->tipe          = $request->input('tipe');

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('nominal'), $trans);

        $invoice->nominal = (int)$value;

        $invoice->save();

        return redirect('invoice');
    }

    public function doDelete(Request $request, $id=null)
    {
        if($id)
        {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();

            $notif = 'Delete data success!';
            return redirect('invoice'); 
        }       

    }

}
