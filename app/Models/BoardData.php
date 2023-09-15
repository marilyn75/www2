<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardData extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "board_datas";
    protected $fillable = [
        'board_id',
        'title',
        'content',
        'password',
        'writer',
        'hits',
        'is_secret',
        'is_notice',
        'created_user_id',
        'created_ip',
        'updated_user_id',
        'updated_ip',
    ];

    // 유효성 검사 조건
    public static $rules = [
        'title' => 'required|min:5|max:50',
        'content' => 'required',
    ];

    public function conf(){
        return $this->belongsTo(BoardConf::class);
    }


}
