<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_documents', function (Blueprint $table) {
      $table->id();
      $table->string('name', 255);
      $table->string('type', 255);
      $table->string('uri', 255);
      $table->string('uuid', 36);
      $table->nullableMorphs('fileable');
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
    Schema::dropIfExists('user_documents');
  }
  };
