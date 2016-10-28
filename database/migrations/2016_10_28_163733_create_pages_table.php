<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pages', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('subject_id')->unsigned();
          $table->string('menu_name');
          $table->smallInteger('position');
          $table->tinyInteger('visible');
          $table->text('content');
          $table->timestamps();
          $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('pages');
    }
}
