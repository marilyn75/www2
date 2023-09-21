<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpFile extends Model
{
    use HasFactory;

    protected $table = "tmpfiles";

    protected $fillable = [
        'ss_id',
        'module',
        'filepath',
        'filename',
        'filename_org',
        'filesize',
        'filetype',
        'num',
        'created_ip',
        'created_id',
    ];
}
