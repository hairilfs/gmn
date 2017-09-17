<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PerformanceBudget;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_order';

    public function getPb()
    {
    	$data = PerformanceBudget::findOrFail($this->performance_budget_id);
    	// $data = $this->belongsTo('App\PerformanceBudget');
        $retVal = ($data) ? $data->client_name : 'Not found';
    	return $retVal;
    }

    public function po_detail()
    {
    	return $this->hasMany('App\PurchaseOrderDetail', 'po_id');
    }

}
