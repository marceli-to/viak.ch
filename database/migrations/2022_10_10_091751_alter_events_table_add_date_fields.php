<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventsTableAddDateFields extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('events', function (Blueprint $table) {
      $table->dateTime('confirmed_at')->nullable()->after('location_id');
      $table->dateTime('cancelled_at')->nullable()->after('confirmed_at');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('events', function (Blueprint $table) {
      $table->dropColumn('confirmed_at');
      $table->dropColumn('cancelled_at');
    });
  }
}
