<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PerformanceBudget;
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
                return '<a href="'.url('performance_budget/edit/'.$data->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
}
