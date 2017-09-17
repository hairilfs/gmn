<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PurchaseOrder;
use App\PurchaseOrderDetail;
use App\PerformanceBudget;

use Datatables;
use Excel;
use PHPExcel_Worksheet_Drawing;

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
                $btn_action = '<a href="'.url('purchase_order/edit/'.$data->id).'" class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></a> &nbsp;';
                $btn_action .= '<a href="javascript:void(0);" onclick="return confirmDelete('.$data->id.',\''.$data->kepada.'\')" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> &nbsp;';
                $btn_action .= '<a href="'.url('purchase_order/detail/'.$data->id).'" class="btn btn-xs btn-success" title="Detail"><i class="glyphicon glyphicon-search"></i></a>';
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

    public function doDelete(Request $request, $id=null)
    {
        if($id)
        {
            $pod = PurchaseOrder::findOrFail($id);
            $po_detail = PurchaseOrderDetail::where('po_id', $id);
            $pod->delete();
            $po_detail->delete();

            $notif = 'Delete data success!';
            return redirect('purchase_order'); 
        }       

    }

    public function getDetail(Request $request, $po_id=null, $po_detail_id=null)
    {
        $this->data['po'] = PurchaseOrder::findOrFail($po_id);
        $this->data['po_detail'] = $po_detail_id ? PurchaseOrderDetail::findOrFail($po_detail_id) : new PurchaseOrderDetail;
        
        return view('purchase_order_detail', $this->data);
    } 

    public function doDetail(Request $request, $id=null, $po_detail_id=null)
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
            $id_po = $pod->po_id;
            $pod->delete();

            $notif = 'Delete data success!';
            return redirect('purchase_order/detail/'.$id_po);
        } 
        else 
        {
            return redirect('purchase_order');
        }

    }

    public function exportExcel(Request $request, $id=null)
    {
        $po = $id ? PurchaseOrder::findOrFail($id) : new PurchaseOrder;

        Excel::create('PO - '.$po->kepada, function($excel) use ($po) {
            $excel->sheet('Sheet1', function($sheet) use ($po) {

                // $sheet->setMergeColumn(
                //     array(
                //         'columns' => array('A','B'),
                //         'rows' => array(
                //             array(1,5)
                //         )
                //     )
                // );


                // LOGO
                $objDrawing = new PHPExcel_Worksheet_Drawing;
                $objDrawing->setPath(public_path('assets/img/logo.png'));
                $objDrawing->setCoordinates('B2');
                $objDrawing->setWorksheet($sheet);

                // Set width for multiple cells
                $sheet->setWidth(array(
                    'B'     =>  10,
                    'C'     =>  15,
                    'D'     =>  50,
                    'E'     =>  15,
                    'F'     =>  15,
                ));

                $sheet->cell('D2', function($cell) {
                    $cell->setValue('PURCHASE ORDER');
                    $cell->setAlignment('center');
                    $cell->setFont(array(
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                });

                $sheet->cell('D3', function($cell) {
                    $cell->setValue('(ORDER PEMBELIAN)');
                    $cell->setAlignment('center');
                    $cell->setFont(array(
                        'size'       => '14',
                        'bold'       =>  true
                    ));
                });

                $sheet->cell('E2', function($cell) {
                    $cell->setValue('No. Dok.');
                });
                $sheet->cell('E3', function($cell) {
                    $cell->setValue('Tgl Berlaku');
                });
                $sheet->cell('E4', function($cell) {
                    $cell->setValue('No. Revisi');
                });
                $sheet->cell('F2', function($cell) {
                    $cell->setValue(': FM.PUR.02');
                });
                $sheet->cell('F3', function($cell) {
                    $cell->setValue(': 01 Oktober 2009');
                });
                $sheet->cell('F4', function($cell) {
                    $cell->setValue(': 00');
                });

                $sheet->cell('C6', function($cell) use ($po){
                    $cell->setValue('NO : '.$po->purchase_order_no);
                });
                $sheet->cell('E6', function($cell) {
                    $cell->setValue('Jakarta, '.date('d F Y'));
                });

                $sheet->cell('C9', function($cell) {
                    $cell->setValue('Kepada');
                });
                $sheet->cell('D9', function($cell) use ($po) {
                    $cell->setValue(': '.$po->kepada);
                });
                $sheet->cell('C10', function($cell) {
                    $cell->setValue('Alamat');
                });
                $sheet->cell('D10', function($cell) use ($po) {
                    $cell->setValue(': '.$po->address);
                });

                $sheet->cell('C15', function($cell) {
                    $cell->setValue('Telepon/Fax');
                });
                $sheet->cell('D15', function($cell) use ($po) {
                    $cell->setValue(': '.$po->phone);
                });
                $sheet->cell('C16', function($cell) {
                    $cell->setValue('CP');
                });
                $sheet->cell('D16', function($cell) use ($po) {
                    $cell->setValue(': '.$po->person.' - '.$po->position);
                });

                $sheet->cell('B20', function($cell) {
                    $cell->setValue('Kami ingin mengkonfirmasi pesanan kami, sebagai berikut:');
                });

                $sheet->cell('B21', function($cell) {
                    $cell->setValue('Qty');
                });
                $sheet->cell('C21', function($cell) {
                    $cell->setValue('Unit');
                });
                $sheet->cell('D21', function($cell) {
                    $cell->setValue('Uraian');
                });
                $sheet->cell('E21', function($cell) {
                    $cell->setValue('Harga Satuan (Rp)');
                });
                $sheet->cell('F21', function($cell) {
                    $cell->setValue('Total (Rp)');
                });

                $num = 22;
                $total = 0;
                foreach ($po->po_detail as $value) {
                    $sheet->cell('B'.$num, function($cell) use ($value) {
                        $cell->setValue($value->qty);
                    });
                    $sheet->cell('C'.$num, function($cell) use ($value) {
                        $cell->setValue($value->unit);
                    });
                    $sheet->cell('D'.$num, function($cell) use ($value) {
                        $cell->setValue(trim(strip_tags($value->uraian)));
                    });
                    $sheet->cell('E'.$num, function($cell) use ($value) {
                        $cell->setValue(number_format($value->harga,0,',','.'));
                    });
                    $sheet->cell('F'.$num, function($cell) use ($value) {
                        $cell->setValue(number_format($value->harga * $value->qty,0,',','.'));
                    });

                    $total += ($value->harga * $value->qty);
                    $num++;
                }

                $ppn = $total * 0.10; // PPN 10%
                $grand_total = $total + $ppn; // Setelah ditambah PPN

                $sheet->cell('E'.$num, function($cell) {
                    $cell->setValue('TOTAL (Rp)');
                });
                $sheet->cell('F'.$num, function($cell) use ($total) {
                    $cell->setValue(number_format($total,0,',','.'));
                });

                $sheet->cell('E'.($num+1), function($cell) {
                    $cell->setValue('PPN 10% (Rp)');
                });
                $sheet->cell('F'.($num+1), function($cell) use ($ppn) {
                    $cell->setValue(number_format($ppn,0,',','.'));
                });

                $sheet->cell('E'.($num+2), function($cell) {
                    $cell->setValue('GRAND TOTAL (Rp)');
                });
                $sheet->cell('F'.($num+2), function($cell) use ($grand_total) {
                    $cell->setValue(number_format($grand_total,0,',','.'));
                });

                $sheet->cell('B'.($num+4), function($cell) {
                    $cell->setValue('Pembayaran');
                });
                $sheet->cell('C'.($num+4), function($cell) use ($po) {
                    $cell->setValue(': '.$po->pembayaran);
                });

                $sheet->cell('B'.($num+8), function($cell) {
                    $cell->setValue('Pengiriman');
                });
                $sheet->cell('C'.($num+8), function($cell) use ($po) {
                    $cell->setValue(': '.$po->pengiriman);
                });

                $sheet->cell('B'.($num+12), function($cell) {
                    $cell->setValue('Supplier Confirmation,');
                });
                $sheet->cell('B'.($num+13), function($cell) use ($po) {
                    $cell->setValue($po->kepada);
                });
                $sheet->cell('E'.($num+12), function($cell) {
                    $cell->setValue('Best Regards');
                });

                $sheet->cell('B'.($num+20), function($cell) {
                    $cell->setValue('');
                    $cell->setBorder('none', 'none', 'solid', 'none');
                });
                $sheet->cell('E'.($num+20), function($cell) {
                    $cell->setValue('Ir. Bambang Dwi Danarko');
                    $cell->setBorder('none', 'none', 'solid', 'none');
                });

            });
        })->export('xlsx');
    }

}
