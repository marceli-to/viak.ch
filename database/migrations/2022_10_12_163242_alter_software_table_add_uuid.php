<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSoftwareTableAddUuid extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('software', function (Blueprint $table) {
      $table->string('uuid', 36)->after('description');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('software', function (Blueprint $table) {
      $table->dropColumn('uuid');
    });
  }
}
