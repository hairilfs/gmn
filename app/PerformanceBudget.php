<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceBudget extends Model
{
    protected $table = 'performance_budget';

    protected $dates = [
        'created_at',
        'updated_at',
        'start_date',
        'end_date',
        'contract_date'
    ];

    public function getContractDate()
    {
        return $this->contract_date->format('d F Y');
    }

    public function getStartDate()
    {
        return $this->start_date ? $this->start_date->format('d-m-Y') : date('d-m-Y');
    }

    public function getEndDate()
    {
    	return $this->end_date ? $this->end_date->format('d-m-Y') : date('d-m-Y');
    }

    public function deleteToo()
    {
        $pbd    = PerformanceBudgetDetail::where('pb_id', $this->id)->delete(); // hapus semua detail performance budget
        $po     = PurchaseOrder::where('pb_id', $this->id)->get(); // ambil semua purchase order, dgn id saat ini
        
        foreach ($po as $value) { // loop setiap po
            $pod    = PurchaseOrderDetail::where('po_id', $value->id)->delete(); // hapus semua detail po, dengan id po saat ini
            $in     = Invoice::where('po_id', $value->id)->get(); // ambil semua invoice, dgn id po saat ini
            foreach ($in as $value2) { // loop setiap invoice
                $pem = Pembayaran::where('invoice_id', $value2->id)->delete(); // hapus semua pembayaran berdasarkan id invoice saat ini
                
                $value2->delete(); // hapus invoice saat ini
            }

            $value->delete(); // hapus purchase order saat ini

        }

        $pem    = Pembayaran::where('pb_id', $this->id)->delete(); // hapus semua pembayaran berdasarkan id pb saat ini
        $ap     = AdvancePayment::where('pb_id', $this->id)->delete(); // hapus semua advance payment berdasarkan pb saat ini
        
    }

    public function detail()
    {
        return $this->hasMany('App\PerformanceBudgetDetail', 'pb_id', 'id');
    }

    public function performanceProgress()
    {
        $detail = $this->detail;
        $progress = $detail->map(function($item, $key){
           return $item->qty * $item->harga; 
        })->sum();

        return $detail->count() ? $progress : 0;
    }

}
