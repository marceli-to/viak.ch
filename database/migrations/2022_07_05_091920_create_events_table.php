<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('events', function (Blueprint $table) {
      $table->id();
      $table->date('registration_until')->nullable();
      $table->tinyInteger('min_participants')->default(1);
      $table->tinyInteger('max_participants')->default(1);
      $table->tinyInteger('online')->default(0);
      $table->string('uuid', 36);
      $table->tinyInteger('publish')->default(1);
      $table->foreignId('course_id')->constrained();
      $table->foreignId('location_id')->nullable()->constrained();
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
    Schema::dropIfExists('events');
  }
}
