<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'file',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *php
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function hasSocialAccount(){
        return $this->hasMany(SocialAccount::class)->count();
    }

    // 유효성 검사 조건
    public static $rules = [
        // 회원가입
        'register' => [
            'name' => 'required|max:20',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:30|confirmed'
        ],
        // 패스워드변경
        'changepassword' => [
            'curr_password' => 'required|min:6|max:30',
            'password' => 'required|min:6|max:30|confirmed'
        ],
        // 회원정보변경
        'update' => [
            'name' => 'required|max:20',
            'email' => 'required|email|max:255',
        ],
        // 로그인
        'login' => [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:30',
        ],
        // 회원관리 패스워드변경
        'admin_changepassword' => [
            'password' => 'required|min:6|max:30|confirmed'
        ],
    ];
}
