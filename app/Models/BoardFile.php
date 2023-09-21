<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardFile extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'board_data_id',
        'board_data_id',
        'num',
        'filepath',
        'filename',
        'filename_org',
        'filesize',
        'filetype',
        'created_ip',
        'created_id',
        'deleted_ip',
        'deleted_id',
    ];
}
