<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraSaleBd extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_SALE_BD';
    protected $primaryKey = "idx";
}
