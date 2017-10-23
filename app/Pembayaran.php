<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    public function getDetail()
    {
    	if ($this->invoice_id) {
	    	$invoice = Invoice::where('id', $this->invoice_id)->first();
	    	return $invoice->no_invoice;
    	}

    	return str_limit($this->keterangan, 30);
    }

    public function getPbId()
    {
    	$data = \DB::table('pembayaran')
            ->join('invoice', 'pembayaran.invoice_id', '=', 'invoice.id')
            ->join('purchase_order', 'invoice.po_id', '=', 'purchase_order.id')
            ->join('performance_budget', 'purchase_order.pb_id', '=', 'performance_budget.id')
	    	->where('invoice.id', (int)$this->invoice_id)
            ->select('performance_budget.*')
            ->first();

    	// dd($data->id);
        return $data;
    }

    public function getDate()
    {
        return date('d M y H:i', strtotime($this->created_at));
    }

}
