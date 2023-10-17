<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'type',
        'content',
        'created_user_id',
        'created_ip',
        'updated_user_id',
        'updated_ip',
    ];

    public function menu()
    {
        return $this->hasMany(Menu::class, 'content_id');
    }
}
