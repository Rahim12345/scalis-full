<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('cover');
            $table->string('title_az');
            $table->string('slug_az');
            $table->string('title_en');
            $table->string('slug_en');
            $table->string('title_ru');
            $table->string('slug_ru');
            $table->string('sub_title_az');
            $table->string('sub_title_en');
            $table->string('sub_title_ru');
            $table->text('content_az');
            $table->text('content_en');
            $table->text('content_ru');
            $table->boolean('status')->default(1)->comment('1 - published, 0 - unpublished');
            $table->integer('hits')->default(0);
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
        Schema::dropIfExists('blogs');
    }
}
