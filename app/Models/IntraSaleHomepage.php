<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraSaleHomepage extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_SALE_HOMEPAGE';
    protected $primaryKey = "idx";
    const CREATED_AT = 'reg_date';
    const UPDATED_AT = 'modify_date';

    public function sale(){
        return $this->belongsTo(IntraSale::class,'s_idx');
    }
}
