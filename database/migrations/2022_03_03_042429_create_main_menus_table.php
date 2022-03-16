<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_menus', function (Blueprint $table) {
            $table->id('main_menu_id');
            $table->string('image')->nullable();
            $table->string('name_az');
            $table->string('name_en');
            $table->string('name_ru');
            $table->string('description_az');
            $table->string('description_en');
            $table->string('description_ru');
            $table->string('slug_az');
            $table->string('slug_en');
            $table->string('slug_ru');
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
        Schema::dropIfExists('main_menus');
    }
}
