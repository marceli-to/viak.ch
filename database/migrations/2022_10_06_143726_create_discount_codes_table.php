<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCodesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('discount_codes', function (Blueprint $table) {
      $table->id();
      $table->string('code', 14)->unique();
      $table->decimal('amount', 8, 0)->default(0);
      $table->date('valid_from')->nullable();
      $table->date('valid_to')->nullable();
      $table->tinyInteger('fix')->default(0);
      $table->tinyInteger('percent')->default(0);
      $table->tinyInteger('used')->default(0);
      $table->string('uuid', 36);
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
    Schema::dropIfExists('discount_codes');
  }
}
