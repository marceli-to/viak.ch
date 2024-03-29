<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGridRowsTableAddLayout extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('grid_rows', function (Blueprint $table) {
      $table->string('layout', 3)->after('id');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('grid_rows', function (Blueprint $table) {
      $table->dropColumn('layout');
    });
  }
}
