<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseOrder;

class Invoice extends Model
{
    protected $table = 'invoice';

    public function getPo()
    {
        return $this->hasOne('App\PurchaseOrder', 'id', 'po_id');
    }

    public function po_detail()
    {
    	return $this->hasMany('App\PurchaseOrderDetail', 'po_id');
    }

    public function getDetail()
    {
    	$po = PurchaseOrder::where('id', $this->po_id)->first();
    	return $this->no_invoice .' dari '. $po->kepada;
    }

}
