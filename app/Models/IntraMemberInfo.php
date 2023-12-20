<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraMemberInfo extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_MEMBER_SINFO';
    protected $primaryKey = "idx";

    public function member(){
        return $this->belongsTo(IntraMember::class, 's_user_key', 'user_key');
    }
}
