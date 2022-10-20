<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('team_members', function (Blueprint $table) {
      $table->id();
      $table->string('firstname');
      $table->string('name');
      $table->json('title');
      $table->json('info')->nullable();
      $table->string('uuid', 36);
      $table->tinyInteger('publish')->default(1);
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('team_members');
  }
}
