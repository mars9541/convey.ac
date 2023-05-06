<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentsReceived extends Model
{

    protected $table = 'o_payments_received';
    public function cbr()
	{
	    return $this->belongsTo(CBR_table::class,'payers_CBR_id');

	}
	public function user()
{
		return $this->belongsTo(User::class,'payers_CBR_id');

}

}
