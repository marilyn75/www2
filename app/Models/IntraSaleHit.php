<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraSaleHit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date','s_idx','hits'
    ];
}
