<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Main_model;
class Branch extends Model
{
	
    protected $table = 'f_branch_table';
    protected $fillable = [
        'CBR_id',
    ];
    protected $keyType = 'String';
}
