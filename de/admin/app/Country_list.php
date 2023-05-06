<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country_list extends Model
{
	protected $connection = 'mysql2';
    protected $table = 'country_list';
}
