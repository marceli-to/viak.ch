<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('jobs', function (Blueprint $table) {
      $table->bigInteger('id');
      $table->string('recipient', 255)->nullable();
      $table->tinyInteger('processed')->default(0);
      $table->longText('error')->nullable();
      $table->morphs('mailable');
      $table->string('mailable_class');
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
    Schema::dropIfExists('jobs');
  }
}
