<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Main_model;
class Credits extends Model
{
	
    protected $table = 'g_credit_usage_history';

   	public function branch()
	{
	    return $this->belongsTo(Branch::class);
	    
	}
}
