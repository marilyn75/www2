<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraMember extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_MEMBER';
    protected $primaryKey = "idx";

    public function info(){
        return $this->hasOne(IntraMemberInfo::class,'s_user_key', 'user_key');
    }

    public function homepageSales(){
        return $this->hasMany(IntraSaleHomepage::class, 'user_id', 'user_id')->where('isDone',1);
    }
}
