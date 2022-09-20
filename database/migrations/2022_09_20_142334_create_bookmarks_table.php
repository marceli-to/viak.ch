<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bookmarks', function (Blueprint $table) {
      $table->id();
      $table->string('uuid', 36);
      $table->foreignId('event_id')->constrained();
      $table->foreignId('user_id')->constrained();
      $table->dateTime('bookmarked_at');
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
    Schema::dropIfExists('bookmarks');
  }
}
