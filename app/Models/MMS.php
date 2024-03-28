<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMS extends Model
{
    protected $connection = 'mysql_intranet';
    protected $table = 'lguplus.MMS_MSG';
    public $timestamps = false;

    protected $fillable = [
        'REQDATE', 'STATUS', 'TYPE', 'PHONE', 'CALLBACK', 'SUBJECT', 'MSG', 'etc1', 'etc2', 'etc3', 'etc4'
    ];
}
