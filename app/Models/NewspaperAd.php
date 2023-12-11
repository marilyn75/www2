<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewspaperAd extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'news_code',
        'news_txt',
        'pub_date',
        'created_user_id',
        'created_ip',
        'updated_user_id',
        'updated_ip',
        'deleted_user_id',
        'deleted_ip',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // 유효성 검사 조건
    public $rules = [
        'news_code' => 'required',
        'pub_date' => 'required',
        'file' => 'required|mimes:pdf',
    ];

    public $messages = [
        'news_code.required' => '신문사 필드는 필수입니다.',
        'pub_date.required' => '게재일 필드는 필수입니다.',
        'file.required' => '파일 필드는 필수입니다.',
    ];

    public function files(){
        return $this->hasMany(ModuleFile::class,'module_data_id')->where('module_code','newspaperad');
    }
    public function file(){
        return $this->hasOne(ModuleFile::class,'module_data_id')->where('module_code','newspaperad')->first();
    }
}
