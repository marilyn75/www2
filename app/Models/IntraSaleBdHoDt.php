<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraSaleBdHoDt extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_SALE_BD_HO_DT';
    protected $primaryKey = "idx";

    
}
