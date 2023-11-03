<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleLand extends Model
{
    use HasFactory, SoftDeletes;

    public function building(){
        return $this->hasMany(SaleBuilding::class, 'land_id');
    }
}
