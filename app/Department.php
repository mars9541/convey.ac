<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    public function opentickets()
	{
	    return $this->hasMany(Openticket::class);
	}
}
