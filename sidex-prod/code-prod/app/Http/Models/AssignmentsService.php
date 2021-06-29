<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentsService extends Model
{
    use HasFactory;

    protected $table = 'user_assignments_services';
    public $timestamps = false;

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function ser(){
        return $this->hasOne(Service::class,'id','service_id');
    }
}
