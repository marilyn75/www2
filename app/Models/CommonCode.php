<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksIpAddressesAndUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommonCode extends Model
{
    use HasFactory;
    use NodeTrait;
    use TracksIpAddressesAndUser;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'is_use',
        'class',
        'created_user_id',
        'created_ip',
        'updated_user_id',
        'updated_ip',
    ];

    // 유효성 검사 조건
    public static $rules = [
        'title' => 'required|max:20',
    ];

    public static $messages = [
        'title.required' => '메뉴명 필드는 필수입니다.',
        'code.required' => '메뉴코드 필드는 필수입니다.',
        'code.unique' => '이미 사용중인 메뉴코드 입니다.',
    ];
}
