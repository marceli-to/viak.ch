<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookingsTableAddInvoiceAmount extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('bookings', function (Blueprint $table) {
      $table->decimal('course_fee', 8, 2)->nullable()->default(0.00)->after('number');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('bookings', function (Blueprint $table) {
      $table->dropColumn('course_fee');
    });
  }
}
