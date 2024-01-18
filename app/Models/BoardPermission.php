<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksIpAddressesAndUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoardPermission extends Model
{
    use HasFactory, SoftDeletes;
    use TracksIpAddressesAndUser;

    public $timestamps = true;

    protected $fillable = [
        'board_id', 'role', 
        'write', 'list', 'read', 'read_secret', 'edit_own', 'edit_all', 'delete_own', 'delete_all', 'comment_write', 
        'comment_read', 'comment_read_secret', 'comment_edit_own', 'comment_edit_all', 'comment_delete_own', 'comment_delete_all', 'file_upload', 'file_download',
        'created_user_id',
        'created_ip',
        'updated_user_id',
        'updated_ip',
    ];
}
