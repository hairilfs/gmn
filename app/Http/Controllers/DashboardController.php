<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    function __construct($foo = null)
    {
        $this->middleware('auth');
    }

    public function getDashboard()
    {
        return view('dashboard');
    }
}
