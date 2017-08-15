<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PerformanceBudget;
use App\PerformanceBudgetDetail;
use Datatables;

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
                $btn_action = '<a href="'.url('performance_budget/edit/'.$data->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;';
                $btn_action .= '<a href="'.url('performance_budget/detail/'.$data->id).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Detail</a>';
                return $btn_action;
            })
        ->make(true);
    }

    public function getPerformanceBudget()
    {
        return view('performance');
    }

    public function getAdd(Request $request)
    {
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

        $pb = empty($id) ? new PerformanceBudget : PerformanceBudget::findOrFail($id);

        $pb->client_name        = $request->input('client_name');
        $pb->client_address     = $request->input('client_address');
        $pb->job_title          = $request->input('job_title');
        $pb->contract_number    = $request->input('contract_number');
        $pb->contract_date      = date('Y-m-d H:i:s', strtotime($request->input('contract_date')));

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('value'), $trans);

        $pb->value              = (int)$value;
        
        $pb->save();

        return redirect('performance_budget');
    }

    public function getDetail(Request $request, $id=null)
    {
        $this->data['pb'] = PerformanceBudget::findOrFail($id);
        return view('performance_detail', $this->data);
    } 

    public function doDetail(Request $request, $id=null, $edit=false)
    {
        $this->validate($request, [
                'pekerjaan' => 'required',
                'qty' => 'required|numeric',
                'satuan' => 'required',
                'harga' => 'required',
            ]);

        $pb = $edit ? PerformanceBudgetDetail::findOrFail($id) : new PerformanceBudgetDetail;

        $pb->performance_budget_id  = $id;
        $pb->pekerjaan  = $request->input('pekerjaan');
        $pb->qty        = $request->input('qty');
        $pb->satuan     = $request->input('satuan');

        $trans = array('Rp ' => '', '.' => '');
        $value = strtr($request->input('harga'), $trans);
        $pb->harga              = (int)$value;
        
        $pb->save();

        return redirect('performance_budget/detail/'.$id);
    }

    public function getDetailDatatables(Request $request, $id=null)
    {
        $data = PerformanceBudgetDetail::where('performance_budget_id', $id)->get();
        return Datatables::of($data)
        ->editColumn('harga', function(PerformanceBudgetDetail $data){
            return "Rp " . number_format($data->harga,0,',','.');
        })->editColumn('total_harga', function(PerformanceBudgetDetail $data){
            $total = $data->harga * $data->qty;
            return "Rp " . number_format($total,0,',','.');
        })
        ->addColumn('action', function ($data) {
            $btn_action = '<a href="'.url('performance_budget/edit/'.$data->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> &nbsp;';
            $btn_action .= '<a href="'.url('performance_budget/detail/'.$data->id).'" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Detail</a>';
            return $btn_action;
        })
        ->make(true);

    }
}
