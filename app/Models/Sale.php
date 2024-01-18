<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TracksIpAddressesAndUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, SoftDeletes;
    use TracksIpAddressesAndUser;

    protected $fillable = [
        'tmp_id','sale_code','trade_type','trade_type_txt','sale_type','sale_type_txt','sale_amount','deposit_amount_state','monthly_amount_state',
        'deposit_amount','monthly_amount','premium_amount','maintenance_cost','is_movein_immediately','movein_date','is_movein_nego','land_area',
        'building_area','is_transfer_ownership','supply_area','exclusive_area','floor','total_floor','bath_num','room_num','direction','is_parking',
        'parking_num','title','content','youtube_link','is_open','created_user_id','created_ip','updated_user_id','updated_ip','deleted_user_id','deleted_ip'
    ];

    public function lands(){
        return $this->hasMany(SaleLand::class, 'sale_id')->with('building');
    }
}
