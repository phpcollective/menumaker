<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcmm_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->string('namespace', 255)->index();
            $table->string('controller', 255)->index();
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'])->index();
            $table->string('action', 255)->index();
            $table->boolean('allowed')->default(true);
            $table->timestamps();

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
        Schema::dropIfExists('pcmm_permissions');
    }
}
