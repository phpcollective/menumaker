<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcmmPermissionsTable extends Migration
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
            $table->integer('menu_id')->unsigned()->index();
            $table->string('namespace', 255)->index();
            $table->string('controller', 255)->index();
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'])->index();
            $table->string('action', 255)->index();
            $table->boolean('allowed')->default(true);
            $table->timestamps();

        });

        Artisan::call('db:seed', [
            '--class' => PcmmPermissionsTableSeeder::class,
            '--force'   => true
        ]);
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
