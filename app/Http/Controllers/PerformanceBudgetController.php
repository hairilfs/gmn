<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PerformanceBudgetController extends Controller
{
    function __construct($foo = null)
    {
        $this->middleware('auth');
        $this->data = array();
    }

    public function getPerformanceBudget()
    {
        return view('performance');
    }

    public function getAdd(Request $request)
    {
    	return view('performance_form', $this->data);
    }
}
