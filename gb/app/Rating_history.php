<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rating_history extends Model
{
    protected $table = 'rating_history';
    protected $keyType = 'String';
}
