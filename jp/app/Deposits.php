<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deposits extends Model
{
    protected $table = 'p_referrer_deposits';

    public function user()
	{
	    return $this->belongsTo(CBR_table::class,'CBR_id_of_the_payer_they_referred');
	    
	}
	public function received()
	{
		return $this->belongsTo(PaymentsReceived::class,'received_id');
	}
}

