<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;
    use NodeTrait;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'url',
        'target',
    ];
}
