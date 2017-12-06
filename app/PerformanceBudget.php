<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceBudget extends Model
{
    protected $table = 'performance_budget';

    protected $dates = [
        'created_at',
        'updated_at',
        'contract_date'
    ];

    public function getContractDate()
    {
    	return $this->contract_date->format('d F Y');
    }

}
