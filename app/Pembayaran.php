<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\AdvancePayment;

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

    // public function getPbId()
    // {
    //     $data = \DB::table('pembayaran')
    //         ->join('invoice', 'pembayaran.invoice_id', '=', 'invoice.id')
    //         ->join('purchase_order', 'invoice.po_id', '=', 'purchase_order.id')
    //         ->join('performance_budget', 'purchase_order.pb_id', '=', 'performance_budget.id')
    //         ->where('invoice.id', (int)$this->invoice_id)
    //         ->select('performance_budget.*')
    //         ->first();

    //     return $data;
    // }

    public function getPbId()
    {
    	$data = \DB::table('invoice')
            ->join('purchase_order', 'invoice.po_id', '=', 'purchase_order.id')
            ->join('performance_budget', 'purchase_order.pb_id', '=', 'performance_budget.id')
	    	->where('invoice.id', (int)$this->invoice_id)
            ->select('performance_budget.*')
            ->first();

        return $data;
    }

    public function getDate()
    {
        return date('d M y H:i', strtotime($this->created_at));
    }

    public function getRealisasi($pb_id=null)
    {
        // $data = \DB::table('pembayaran')
        //             ->join('advance_payment', 'pembayaran.pb_id', '=', 'advance_payment.pb_id')
        //             ->where('pembayaran.pb_id', $pb_id)
        //             ->where('advance_payment.pb_id', $pb_id)
        //             ->select('advance_payment.*', 'pembayaran.*')
        //             ->get();

        // return $data;

        $data = [];

        $pembayaran = self::where('pb_id', $pb_id)->get();
        $advance_payment = AdvancePayment::where('pb_id', $pb_id)->get();

        foreach ($pembayaran as $value) {
            $sort = strtotime($value->created_at);
            $data[$sort]['jenis']      = 'Pembayaran';
            $data[$sort]['date']       = date('d F Y H:i', strtotime($value->created_at));
            $data[$sort]['detail']     = $value->invoice_id ? $this->getInvoiceNo($value->invoice_id) : str_limit($value->keterangan, 30);
            $data[$sort]['jumlah']     = $value->jumlah;
        }

        foreach ($advance_payment as $value) {
            $sort = strtotime($value->created_at);
            $data[$sort]['jenis']      = 'Advance Payment';
            $data[$sort]['date']       = date('d F Y H:i', strtotime($value->created_at));
            $data[$sort]['detail']     = $value->request_note;
            $data[$sort]['jumlah']     = $value->request;


        }

        ksort($data);
        // dd($data);
        return $data;

    }

    public function getInvoiceNo($id=null)
    {
        $invoice = Invoice::where('id', $id)->first();
        return $invoice->no_invoice;
    }

}
