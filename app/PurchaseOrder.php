<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PerformanceBudget;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_order';

    public function getPb()
    {
    	$data = PerformanceBudget::findOrFail($this->pb_id);
    	// $data = $this->belongsTo('App\PerformanceBudget');
        $retVal = ($data) ? $data->client_name : 'Not found';
    	return $retVal;
    }

    public function po_detail()
    {
    	return $this->hasMany('App\PurchaseOrderDetail', 'po_id');
    }

    public function getNom()
    {
        $nom = \DB::select('SELECT SUM(qty * harga) AS total FROM po_detail WHERE po_id = ' . $this->id )[0];
        return $nom;
    }

    public function deleteToo()
    {
        $pod    = PurchaseOrderDetail::where('po_id', $this->id)->delete(); // hapus semua detail po, dengan id po saat ini
        $in     = Invoice::where('po_id', $this->id)->get(); // ambil semua invoice, dgn id po saat ini
        foreach ($in as $value2) { // loop setiap invoice
            $pem = Pembayaran::where('invoice_id', $value2->id)->delete(); // hapus semua pembayaran berdasarkan id invoice saat ini
            
            $value2->delete(); // hapus invoice saat ini
        }


        $pem    = Pembayaran::where('pb_id', $this->id)->delete(); // hapus semua pembayaran berdasarkan id pb saat ini
        $ap     = AdvancePayment::where('pb_id', $this->id)->delete(); // hapus semua advance payment berdasarkan pb saat ini

        // dd('ok!');

    }

}
