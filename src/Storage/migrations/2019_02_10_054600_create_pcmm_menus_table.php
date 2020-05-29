<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use PhpCollective\MenuMaker\Storage\Menu;
use Illuminate\Database\Migrations\Migration;

class CreatePcmmMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcmm_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->nestedSet();
            $table->string('name', 100);
            $table->string('alias', 100)->unique();
            $table->json('routes')->nullable();
            $table->string('link', 255)->nullable();
            $table->string('icon', 100)->nullable();
            $table->string('class', 100)->nullable();
            $table->string('attr', 100)->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->enum('privilege', ['PUBLIC', 'PROTECTED', 'PRIVATE'])->default(Menu::DEFAULT_PRIVILAGE);
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('pcmm_menus')->onDelete('restrict');

        });

        Artisan::call('db:seed', [
            '--class' => PcmmMenusTableSeeder::class,
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcmm_menus');
    }
}
