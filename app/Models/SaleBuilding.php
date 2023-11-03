<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleBuilding extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'land_id','mgmBldrgstPk','bldNm','dongNm','mainPurpsCdNm','etcPurps','strctCdNm','etcStrct','grndFlrCnt','ugrndFlrCnt','rideUseElvtCnt',
        'emgenUseElvtCnt','indrMechUtcnt','oudrMechUtcnt','indrAutoUtcnt','oudrAutoUtcnt','platArea','archArea','bcRat','totArea','vlRatEstmTotArea','vlRat'
    ];

    
}
