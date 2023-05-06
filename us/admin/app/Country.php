<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	protected $connection = 'mysql2';
    protected $table = 'countries';
}
