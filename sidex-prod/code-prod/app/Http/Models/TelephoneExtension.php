<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelephoneExtension extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'telephone_extensions';
    protected $hidden = ['created_at', 'updated_at'];

    public function ser(){
        return $this->hasOne(Service::class,'id','service_id');
    }
}
