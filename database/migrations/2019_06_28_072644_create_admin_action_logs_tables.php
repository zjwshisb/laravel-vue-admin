<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminActionLogsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_action_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('route', 255)->comment('路由');
            $table->integer('admin_id')->comment('adminId');
            $table->text('params')->comment('请求参数');
            $table->text('user_agent')->comment('userAgent');
            $table->string('action_ip',255)->comment('操作ip');
            $table->string('method', 20)->comment('请求方法');
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
        Schema::dropIfExists('admin_action_logs_tables');
    }
}
