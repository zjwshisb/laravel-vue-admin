<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',64)->index()->comment('用户名');
            $table->string('password',128)->comment('密码');
            $table->tinyInteger('is_super')->comment('是否超级管理员')->default(0);
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->string('api_token',128)->nullable()->comment('登陆token');
            $table->dateTime('expire_time')->nullable()->comment('token过期时间');
            $table->dateTime('last_login_at')->nullable()->comment('最后登陆时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
