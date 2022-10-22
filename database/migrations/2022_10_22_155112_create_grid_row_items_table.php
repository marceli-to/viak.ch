<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGridRowItemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('grid_row_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('course_id')->nullable()->constrained();
      $table->foreignId('news_id')->nullable()->constrained();
      $table->text('code')->nullable();
      $table->tinyInteger('position')->default(0);
      $table->foreignId('grid_row_id')->constrained();
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
    Schema::dropIfExists('grid_row_items');
  }
}
