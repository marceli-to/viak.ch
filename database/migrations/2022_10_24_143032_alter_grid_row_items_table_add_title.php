<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGridRowItemsTableAddTitle extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('grid_row_items', function (Blueprint $table) {
      $table->json('title')->nullable()->after('id');
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
      $table->dropColumn('title');
    });
  }
}
