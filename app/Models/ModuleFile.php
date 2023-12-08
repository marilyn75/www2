<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'module_code',
        'module_data_id',
        'num',
        'filepath',
        'filename',
        'filename_org',
        'filesize',
        'filetype',
        'created_ip',
        'created_user_id',
        'deleted_ip',
        'deleted_user_id'
    ];
}
