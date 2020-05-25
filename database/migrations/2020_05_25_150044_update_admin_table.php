<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table){
           $table->tinyInteger('is_forbidden')->default(0);
           $table->dateTime('last_login_at')->nullable();
        });
        Schema::table('admin_action_logs', function (Blueprint $table){
           $table->string('name', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table){
            $table->dropColumn('is_forbidden');
            $table->dropColumn('last_login_at');
        });
        Schema::table('admin_action_logs', function (Blueprint $table){
            $table->dropColumn('name');
        });
    }
}
