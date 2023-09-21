<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardConf extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'board_name', 
        'skin',
        'use_secret',
        'use_comment',
        'file_num',
        'file_size',
        'file_total_size',
        'file_type',
        'use_category',
        'category_data',
    ];

    // 유효성 검사 조건
    public static $rules = [
        'board_name' => 'required|max:20',
        'file_num' => 'numeric',
        'file_size' => 'numeric',
        'file_total_size' => 'numeric',
    ];

    public function datas_count(){
        return $this->hasMany(BoardData::class)->count();
    }
}
