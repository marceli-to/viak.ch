<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventsTableAddStateFields extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('events', function (Blueprint $table) {
      $table->tinyInteger('confirmed')->default(0)->after('publish');
      $table->tinyInteger('cancelled')->default(0)->after('confirmed');
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
      $table->dropColumn('confirmed');
      $table->dropColumn('cancelled');
    });
  }
}
