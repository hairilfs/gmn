<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PerformanceBudget;
use App\PerformanceBudgetDetail;
use Datatables;
use DB;

class PerformanceBudgetController extends Controller
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
                $btn_action = '<a href="'.url('performance_budget/edit/'.$data->id).'" class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a> &nbsp;';
                $btn_action .= '<a href="javascript:void(0);" onclick="return confirmDelete('.$data->id.',\''.$data->client_name.'\')" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a> &nbsp;';
                $btn_action .= '<a href="'.url('performance_budget/detail/'.$data->id).'" class="btn btn-xs btn-success" title="Detail"><i class="glyphicon glyphicon-search"></i></a> &nbsp;';
                $btn_action .= '<a href="'.url('realisasi/detail/'.$data->id).'" class="btn btn-xs btn-warning" title="Realisasi"><i class="glyphicon glyphicon-stats"></i></a>';
                return $btn_action;
        })->editColumn('value', function(PerformanceBudget $data){
            return "Rp " . number_format($data->value,0,',','.');
        })->editColumn('contract_date', function(PerformanceBudget $data){
            return date('d M Y', strtotime($data->contract_date));
        })
        ->addIndexColumn()
        ->make(true);
    }

    public function getPerformanceBudget()
    {
        return view('performance');
    }

    public function getAdd(Request $request, $id=null)
    {
        $this->data['pb'] = $id ? PerformanceBudget::findOrFail($id) : new PerformanceBudget;
        return view('performance_form', $this->data);
    }

    public function doAdd(Request $request, $id=null)
    {

        $this->validate($request, [
                'client_name' => 'required',
                'client_address' => 'required',
                'job_title' => 'required',
                'contract_number' => 'required',
                'contract_date' => 'required',
                'value' => 'required',
            ]);

        // dd($request);

        $pb = empty($id) ? new PerformanceBudget : PerformanceBudget::findOrFail($id);

        $pb->client_name        = $request->input('client_name');
        $pb->client_address     = $request->input('client_address');
        $pb->job_title          = $request->input('job_title');
        $pb->contract_number    = $request->input('contract_number');
        $pb->contract_date      = date('Y-m-d', strtotime($request->input('contract_date')));

        $pelaksanaan            = explode(' s.d. ', $request->pelaksanaan);
        $pb->start_date         = date('Y-m-d', strtotime($pelaksanaan[0]));
        $pb->end_date           = date('Y-m-d', strtotime($pelaksanaan[1]));

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('value'), $trans);

        $pb->value              = floatval($value);
        
        $pb->save();

        return redirect('performance_budget');
    }

    public function getDetail(Request $request, $id=null)
    {
        $this->data['pb'] = PerformanceBudget::findOrFail($id);
        // $this->data['grand_total'] = PerformanceBudgetDetail::findOrFail($id)->select(DB::raw('SUM( qty * harga) as grand_total'));
        $this->data['grand_total'] = DB::select('SELECT SUM(qty * harga) AS total FROM performance_budget_detail WHERE pb_id = ' . $id )[0];
        return view('performance_detail', $this->data);
    } 

    public function doDetail(Request $request, $id=null)
    {
        $this->validate($request, [
                'pekerjaan' => 'required',
                'qty' => 'required|numeric',
                'satuan' => 'required',
                'harga' => 'required',
            ]);

        if($request->input('edit'))
        {
            $pb = PerformanceBudgetDetail::findOrFail($request->input('edit'));
            $notif = 'Edit data success!';
        }
        else 
        {
            $pb = new PerformanceBudgetDetail;
            $pb->pb_id  = $id;
            $notif = 'Add data success!';
        }

        $pb->pekerjaan  = $request->input('pekerjaan');
        $pb->qty        = $request->input('qty');
        $pb->satuan     = $request->input('satuan');

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('harga'), $trans);
        $pb->harga              = floatval($value);
        
        $pb->save();

        return redirect('performance_budget/detail/'.$id);
    }

    public function doDelete(Request $request, $id=null)
    {
        if($id)
        {
            $pb = PerformanceBudget::findOrFail($id);
            $pb->deleteToo();
            $pb->delete();

            $notif = 'Delete data success!';
            return redirect('performance_budget'); 
        }       

    }

    public function doDetailDelete(Request $request, $id=null)
    {
        if($id)
        {
            $pbd = PerformanceBudgetDetail::findOrFail($id);
            $id_pb = $pbd->pb_id;
            $pbd->delete();
            $notif = 'Delete data success!';
            return redirect('performance_budget/detail/'.$id_pb);
        } 
        else 
        {
            return redirect('performance_budget');
        }

    }

    public function getDetailDatatables(Request $request, $id=null)
    {
        $data = PerformanceBudgetDetail::where('pb_id', $id)->get();
        return Datatables::of($data)
        ->editColumn('harga', function(PerformanceBudgetDetail $data){
            return "Rp " . number_format($data->harga,0,',','.');
        })->editColumn('total_harga', function(PerformanceBudgetDetail $data){
            $total = $data->harga * $data->qty;
            return "Rp " . number_format($total,0,',','.');
        })
        ->addColumn('action', function (PerformanceBudgetDetail $data) {
            $btn_action  = '<a href="#" onclick="return false;" class="btn btn-xs btn-primary edit-pb-detail" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;';
            $btn_action .= '<a href="'.url('performance_budget/detail/delete/'.$data->id).'" onclick="return confirmDelete(\''.$data->pekerjaan.'\')" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
            return $btn_action;
        })
        ->setRowAttr([
            'data-id' => function(PerformanceBudgetDetail $data) {
                return $data->id;
            },
            'data-pekerjaan' => function(PerformanceBudgetDetail $data) {
                return $data->pekerjaan;
            },
            'data-qty' => function(PerformanceBudgetDetail $data) {
                return $data->qty;
            },
            'data-satuan' => function(PerformanceBudgetDetail $data) {
                return $data->satuan;
            },
            'data-harga' => function(PerformanceBudgetDetail $data) {
                return $data->harga;
            }
        ])
        ->addIndexColumn()
        ->make(true);

    }
}
