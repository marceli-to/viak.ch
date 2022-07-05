<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('event_dates', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->time('time_start', 0)->nullable();
        $table->time('time_end', 0)->nullable();
        $table->foreignId('event_id')->constrained();
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
      Schema::dropIfExists('event_dates');
    }
}
