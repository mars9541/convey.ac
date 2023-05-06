<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CUR_table extends Model
{
    protected $table = 'd_cur_table';
    protected $keyType = 'String';
}
