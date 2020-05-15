<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('has_permission')->default(0);
            $table->timestamps();
        });
        Schema::create('role_admin_menus',function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->index();
            $table->integer('menu_id')->index();
        });
        Schema::create('admin_menu_permissions', function (Blueprint $table){
            $table->id();
            $table->integer('menu_id')->index();
            $table->integer('permission_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_menus');
        Schema::dropIfExists('role_admin_menus');
        Schema::dropIfExists('admin_menu_permissions');
    }
}
