<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_addresses', function (Blueprint $table) {
      $table->id();
      $table->string('firstname')->nullable();
      $table->string('name')->nullable();
      $table->string('company')->nullable();
      $table->string('street', 255)->nullable();
      $table->string('street_no', 15)->nullable();
      $table->string('zip', 15)->nullable();
      $table->string('city', 255)->nullable();
      $table->string('uuid', 36);
      $table->foreignId('country_id')->constrained();
      $table->foreignId('user_id')->constrained();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_addresses');
  }
}
