<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('ibm')->unique();
            $table->integer('phone')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('password_code')->nullable();
            $table->text('permissions')->nullable();
            $table->integer('role')->default('2');
            $table->integer('status')->default('0');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(array('id'=>'1','name'=>'Daniel','lastname'=>'Velasquez','ibm'=>'37732','email'=>'daniel.vel@hotmail.com', 'password' => '$2y$10$nTAXJ6Si3aDBxm8CXgljAuMf/HPxciU/iVA3pEa.l/u/LdeXtQE5i', 'permissions' => '{"home":"true","dashboard":"true","dashboard_small_stats":"true","municipalities":"true","units":"true","unit_add":"true","unit_edit":"true","unit_delete":"true","unit_search":"true","services":"true","service_add":"true","service_edit":"true","service_delete":"true","service_search":"true","telephone_extensions":"true","telephone_extension_add":"true","telephone_extension_edit":"true","telephone_extension_delete":"true","telephone_extension_search":"true","reports":"true","report_user":"true","report_bitacora":"true","bitacoras":"true","user_list":"true","user_add":"true","user_edit":"true","user_banned":"true","user_delete":"true","user_reset_password":"true","user_permissions":"true","user_assignments":"true","settings":"true"}', 'role' =>'0', 'status'=>'1'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
