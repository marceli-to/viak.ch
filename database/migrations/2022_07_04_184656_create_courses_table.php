<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('courses', function (Blueprint $table) {
      $table->id();
      $table->string('title', 255);
      $table->text('subtitle')->nullable();
      $table->text('text')->nullable();
      $table->decimal('fee', 8, 2)->nullable()->default(0.00);
      $table->text('reviews')->nullable();
      $table->text('seo_description')->nullable();
      $table->text('seo_tags')->nullable();
      $table->string('uuid', 36);
      $table->tinyInteger('publish')->default(1);
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
    Schema::dropIfExists('courses');
  }
}
