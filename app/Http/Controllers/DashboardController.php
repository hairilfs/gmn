<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PerformanceBudget;


class DashboardController extends Controller
{
	public $data = array();

    function __construct($foo = null)
    {
        $this->middleware('auth');
    }

    public function getDashboard()
    {
    	// $this->data['pb'] = PerformanceBudget::orderBy('created_at', 'desc')->first();
    	$this->data['pb'] = PerformanceBudget::find(4);
    	$this->data['pb_chart'] = app()->chartjs
	        ->name('pieChartTest')
	        ->type('pie')
	        ->size(['width' => 400, 'height' => 200])
	        ->labels(['Nilai kontrak', 'Perf. budget'])
	        ->datasets([
	            [
	                'backgroundColor' => ['#FF6384', '#36A2EB'],
	                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
	                'data' => [
	                	$this->data['pb']->value, 
	                	$this->data['pb']->performanceProgress(),
	                ]
	            ]
	        ])
	        ->options([]);

        return view('dashboard', $this->data);
    }
}
