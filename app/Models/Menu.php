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
        'code',
        'title',
        'type',
        'top_image',
        'board_id',
        'content_id',
        'url',
        'target',
        'is_use',
        'created_user_id',
        'created_ip',
        'updated_user_id',
        'updated_ip',
    ];

    // 유효성 검사 조건
    public static $rules = [
        'title' => 'required|max:20',
        'code' => 'required|unique:menus,code',
    ];

    public static $messages = [
        'title.required' => '메뉴명 필드는 필수입니다.',
        'code.required' => '메뉴코드 필드는 필수입니다.',
        'code.unique' => '이미 사용중인 메뉴코드 입니다.',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
