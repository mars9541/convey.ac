<?php

namespace App;

use App\RDB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
HeadingRowFormatter::default('none');
class RecordImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
      
        return $row;
    }
}