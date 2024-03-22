<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\TracksIpAddressesAndUser;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, SoftDeletes;
    use LogsActivity;
    use TracksIpAddressesAndUser;

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
        'zip_code',
        'address',
        'address_detail',
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

    public function hasSocialAccounts(){
        return $this->hasMany(SocialAccount::class)->count();
    }

    public function chatUserChannels(){
        return $this->hasMany(ChatUser::class, 'user_id')->with('channel');
    }

    public function intraSaleFavorites(){
        return $this->hasMany(UserSaleFavorite::class, 'user_id');
    }

    public function auctionFavorites(){
        return $this->hasMany(UserAuctionFavorite::class, 'user_id');
    }

    // 유효성 검사 조건
    public static $rules = [
        // 회원가입
        'register' => [
            'name' => 'required|max:20',
            // 'email' => 'required|email|max:255|unique:users,email',
            'email' => 'required|email|max:255|unique:users,email,{$this->user->id},id,deleted_at,NULL',
            'password' => 'required|min:6|max:30|confirmed',
            'isCert' => 'required',
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

    // protected static $logAttributes = ['name', 'email'];
    // protected static $logName = 'user';
    
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('user')
            // 예를 들어, 로그 기록에 추가할 속성을 설정할 수 있습니다.
            ->logOnly($this->fillable)
            // ->logAll()
            // 로그를 기록할 때 발생시킬 이벤트를 설정할 수 있습니다.
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

}
