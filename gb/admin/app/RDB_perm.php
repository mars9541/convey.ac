<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RDB_perm extends Model
{
    protected $table = 'm_record_databank_perm';
    protected $keyType = 'String';
}
