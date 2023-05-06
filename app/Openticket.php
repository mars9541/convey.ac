<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Openticket extends Model
{
    protected $table = 'openticket';

   	public function country()
	{
	    return $this->belongsTo(Country::class);
	}
	public function department()
	{
	    return $this->belongsTo(Department::class);
	}

	public function open_user()
	{
	    return $this->belongsTo(User::class,'opened_by');
	    
	}
	public function reply_user()
	{
	    return $this->belongsTo(User::class,'replied_by');
	    
	}

	public function from_user()
	{
	    return $this->belongsTo(User::class,'sent_by');
	    
	}
	


}
