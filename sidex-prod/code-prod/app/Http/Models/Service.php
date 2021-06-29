<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'services';
    protected $hidden = ['created_at', 'updated_at'];

    public function unit(){
        return $this->hasOne(Unit::class,'id','unit_id');
    }
}
