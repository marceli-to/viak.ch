<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bookings', function (Blueprint $table) {
      $table->id();
      $table->string('uuid', 36);
      $table->string('number', 6);
      $table->text('invoice_address')->nullable();
      $table->tinyInteger('billed')->default(0);
      $table->tinyInteger('cancelled')->default(0);
      $table->foreignId('event_id')->constrained();
      $table->foreignId('user_id')->constrained();
      $table->dateTime('booked_at');
      $table->dateTime('cancelled_at')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('bookings');
  }
}
