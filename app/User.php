<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use App\Country;
class User extends Authenticatable
{
    use Notifiable;
    
    public function __construct()

    {
        if(strlen(\Request::segment(1))==2)
        {
           $this->connection = 'mysql2';
           $database_name = Country::where('country_code',\Request::segment(1))->first()->database_name;
            \Config::set('database.connections.mysql2.database', $database_name);
           // dd($database_name);
        }
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function opentickets()
    {
        return $this->hasMany(Openticket::class);
    }


}
