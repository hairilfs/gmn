<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\PerformanceBudget;
use Datatables;

class PurchaseOrderController extends Controller
{
    function __construct($foo = null)
    {
        $this->middleware('auth');
        $this->data = array();
    }

    public function getDatatables()
    {
        return Datatables::of(PurchaseOrder::query())
        ->addColumn('action', function ($data) {
                $btn_action = '<a href="'.url('purchase_order/edit/'.$data->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;';
                $btn_action .= '<a href="'.url('purchase_order/detail/'.$data->id).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-search"></i> Detail</a>';
                return $btn_action;
        })->editColumn('pb', function(PurchaseOrder $data){
            return $data->getPb();
        })->make(true);
    }

    public function getPurchaseOrder()
    {
        return view('purchase_order');
    }

    public function getAdd(Request $request, $id=null)
    {
        $this->data['pb'] = PerformanceBudget::get();
        $this->data['po'] = $id ? PurchaseOrder::findOrFail($id) : new PurchaseOrder;
        return view('purchase_order_form', $this->data);
    }

    public function doAdd(Request $request, $id=null)
    {
        $this->validate($request, [
                'purchase_order_no' => 'required',
                'kepada' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'person' => 'required',
                'position' => 'required',
            ]);

        $po = empty($id) ? new PurchaseOrder : PurchaseOrder::findOrFail($id);

        $po->performance_budget_id  = $request->input('performance_budget_id');
        $po->purchase_order_no  = $request->input('purchase_order_no');
        $po->kepada             = $request->input('kepada');
        $po->address            = $request->input('address');
        $po->phone              = $request->input('phone');
        $po->person             = $request->input('person');
        $po->position           = $request->input('position');       
        $po->pembayaran         = $request->input('pembayaran');       
        $po->pengiriman         = $request->input('pengiriman');       
        $po->save();

        return redirect('purchase_order');
    }

    public function getDetail(Request $request, $id=null)
    {
        $this->data['po'] = PurchaseOrder::findOrFail($id);
        return view('purchase_order_detail', $this->data);
    } 

    public function doDetail(Request $request, $id=null)
    {
        $this->validate($request, [
                'qty' => 'required|numeric',
                'unit' => 'required',
                'uraian' => 'required',
                'harga' => 'required',
            ]);

        if($request->input('edit'))
        {
            $po = PurchaseOrderDetail::findOrFail($request->input('edit'));
            $notif = 'Edit data success!';
        }
        else 
        {
            $po = new PurchaseOrderDetail;
            $po->po_id  = $id;
            $notif = 'Add data success!';
        }

        $po->unit   = $request->input('unit');
        $po->qty    = $request->input('qty');
        $po->uraian = $request->input('uraian');

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('harga'), $trans);
        $po->harga              = (int)$value;
        
        $po->save();

        return redirect('purchase_order/detail/'.$id);
    }

    public function doDetailDelete(Request $request, $id=null)
    {
        if($id)
        {
            $pod = PurchaseOrderDetail::findOrFail($id);
            $id_po = $pod->purchase_order_id;
            $pod->delete();
            $notif = 'Delete data success!';
            return redirect('purchase_order/detail/'.$id_po);
        } 
        else 
        {
            return redirect('purchase_order');
        }

    }

    public function getDetailDatatables(Request $request, $id=null)
    {
        $data = PurchaseOrderDetail::where('purchase_order_id', $id)->get();
        return Datatables::of($data)
        ->editColumn('harga', function(PurchaseOrderDetail $data){
            return "Rp " . number_format($data->harga,0,',','.');
        })->editColumn('total_harga', function(PurchaseOrderDetail $data){
            $total = $data->harga * $data->qty;
            return "Rp " . number_format($total,0,',','.');
        })
        ->addColumn('action', function (PurchaseOrderDetail $data) {
            $btn_action  = '<a href="#" onclick="return false;" class="btn btn-xs btn-primary edit-po-detail" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;';
            $btn_action .= '<a href="'.url('purchase_order/detail/delete/'.$data->id).'" onclick="return confirmDelete(\''.$data->pekerjaan.'\')" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
            return $btn_action;
        })
        ->setRowAttr([
            'data-id' => function(PurchaseOrderDetail $data) {
                return $data->id;
            },
            'data-pekerjaan' => function(PurchaseOrderDetail $data) {
                return $data->pekerjaan;
            },
            'data-qty' => function(PurchaseOrderDetail $data) {
                return $data->qty;
            },
            'data-satuan' => function(PurchaseOrderDetail $data) {
                return $data->satuan;
            },
            'data-harga' => function(PurchaseOrderDetail $data) {
                return $data->harga;
            }
        ])
        ->make(true);

    }
}
