<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentsUnit extends Model
{
    use HasFactory;

    protected $table = 'user_assignments_units';
    public $timestamps = false;

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function unit(){
        return $this->hasOne(Unit::class,'id','unit_id');
    }
}
