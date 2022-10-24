<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGridRowItemsTableAddRatio extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('grid_row_items', function (Blueprint $table) {
      $table->string('ratio')->nullable()->after('code');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('grid_row_items', function (Blueprint $table) {
      $table->dropColumn('ratio');
    });
  }
}
