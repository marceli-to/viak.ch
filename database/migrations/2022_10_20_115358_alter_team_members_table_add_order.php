<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTeamMembersTableAddOrder extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('team_members', function (Blueprint $table) {
      $table->tinyInteger('order')->default(-1)->after('publish');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('team_members', function (Blueprint $table) {
      $table->dropColumn('order');
    });
  }
}
