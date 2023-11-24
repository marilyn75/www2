<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntraSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mysql_intranet';
    protected $table = 'CS_SALE';
    protected $primaryKey = "idx";
    const CREATED_AT = 'reg_date';
    const UPDATED_AT = 'modify_date';
    const DELETED_AT = 'del_date';

    public function files(){
        return $this->hasMany(IntraModuleFile::class, 'parentIDX')->where('file_code','SaleNew.files');
    }

    public function lands(){
        return $this->hasMany(IntraSaleLand::class, 's_idx');
    }

    public function building(){
        return $this->hasMany(IntraSaleBd::class, 's_idx');
    }

    public function users(){
        return $this->hasMany(IntraSaleUser::class, 's_idx')->where('chkescape',0)->orderBy('chk_master','desc')->with('sawon');
    }
}
