<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseVideosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('course_videos', function (Blueprint $table) {
      $table->id();
      $table->string('title')->nullable();
      $table->text('code');
      $table->string('uuid', 36);
      $table->tinyInteger('order')->default(-1);
      $table->tinyInteger('publish')->default(1);
      $table->foreignId('course_id')->constrained();
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
    Schema::dropIfExists('course_videos');
  }
}
