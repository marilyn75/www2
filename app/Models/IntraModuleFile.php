<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraModuleFile extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_MODULE_FILES';
    protected $primaryKey = "idx";
    // const CREATED_AT = 'reg_date';
    // const UPDATED_AT = 'modify_date';
}
