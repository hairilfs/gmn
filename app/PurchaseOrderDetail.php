<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PerformanceBudget;

class PurchaseOrderDetail extends Model
{
    protected $table = 'po_detail';

    public function shortUraian() {
    	$text = trim(strip_tags($this->uraian));
    	return str_limit($text, 30);
    }
}
