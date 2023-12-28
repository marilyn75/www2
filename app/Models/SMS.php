<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $connection = 'mysql_intranet';
    protected $table = 'lguplus.SC_TRAN';
    public $timestamps = false;
}
