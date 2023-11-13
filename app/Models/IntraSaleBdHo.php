<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraSaleBdHo extends Model
{
    use HasFactory;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_SALE_BD_HO';
    protected $primaryKey = "idx";

    public function details(){
        return $this->hasMany(IntraSaleBdHoDt::class, 'h_idx');
    }
}
