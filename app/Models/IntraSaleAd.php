<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntraSaleAd extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_SALE_AD';
    protected $primaryKey = "idx";
    const CREATED_AT = 'reg_date';
    const UPDATED_AT = 'modify_date';
    const DELETED_AT = 'del_date';

    public function sale(){
        return $this->belongsTo(IntraSale::class,'s_idx');
    }
}
