<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraSaleUser extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_SALE_USER';
    protected $primaryKey = "idx";

    public function sawon(){
        return $this->hasOne(IntraMember::class, 'user_key', 'user_key')->with('info');
    }
}
