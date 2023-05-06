<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Withdrawals extends Model
{
    protected $table = 'q_referrer_withdrawals';
    public function cbr()
	{
	    return $this->belongsTo(CBR_table::class,'referrer_CBR_id');
	    
	}
}
