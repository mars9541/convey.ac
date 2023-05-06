<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Country;

class CBR_table extends Model
{

    protected $table = 'e_cbr_table';
    protected $keyType = 'String';

    public static function set_database_name($country_code) {
        $database_info = Country::where('country_code', $country_code)->first();
        \Config::set('database.connections.mysql.host', $database_info->database_host);
        \Config::set('database.connections.mysql.database', $database_info->database_name);
        \Config::set('database.connections.mysql.username', $database_info->database_username);
        \Config::set('database.connections.mysql.password', $database_info->database_password);

        DB::reconnect('mysql');
    }

    public static function set_default_database_name() {
        \Config::set('database.connections.mysql.database', env('DB_DATABASE_SECOND', ''));
        \Config::set('database.connections.mysql.host', env('DB_HOST_SECOND', ''));
        \Config::set('database.connections.mysql.username', env('DB_USERNAME_SECOND', ''));
        \Config::set('database.connections.mysql.password', env('DB_PASSWORD_SECOND', ''));

        DB::reconnect('mysql');
    }

}
