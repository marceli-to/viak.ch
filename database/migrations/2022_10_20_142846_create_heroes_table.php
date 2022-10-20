<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('heroes', function (Blueprint $table) {
      $table->id();
      $table->string('title', 255);
      $table->string('slug', 255);
      $table->string('uuid', 36);
      $table->tinyInteger('publish')->default(1);
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
    Schema::dropIfExists('heroes');
  }
}
