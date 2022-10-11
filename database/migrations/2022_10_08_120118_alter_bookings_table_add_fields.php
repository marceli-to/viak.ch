<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBookingsTableAddFields extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('bookings', function (Blueprint $table) {
      $table->string('discount_code', 14)->nullable()->after('course_fee');
      $table->decimal('discount_amount', 8, 0)->nullable()->default(0.00)->after('discount_code');
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
      $table->dropColumn('discount_code');
      $table->dropColumn('discount_amount');
    });
  }
}
