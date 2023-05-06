<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\Openticket;
class Email extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'x_email_template';

    public function __construct()
    {
        if(strlen(\Request::segment(1))==2)
        {

        }
    }

    public static function set_database_name($country_code) {
        $database_info = Country::where('country_code', $country_code)->first();
        \Config::set('database.connections.mysql2.database', $database_info->database_name);
        \Config::set('database.connections.mysql2.host', $database_info->database_host);
        \Config::set('database.connections.mysql2.username', $database_info->database_username);
        \Config::set('database.connections.mysql2.password', $database_info->database_password);
    }
}

