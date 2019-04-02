<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRolePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcmm_menu_role', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('menu_id')->unsigned();

            $table->primary(['role_id', 'menu_id']);
            $table->foreign('role_id')->references('id')->on('pcmm_roles')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('pcmm_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcmm_menu_role');
    }
}
