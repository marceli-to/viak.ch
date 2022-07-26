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
      $table->tinyInteger('number')->default(0);
      $table->json('slug');
      $table->json('title');
      $table->json('subtitle');
      $table->json('text');
      $table->decimal('fee', 8, 2)->nullable()->default(0.00);
      $table->text('reviews')->nullable();
      $table->json('seo_description')->nullable();
      $table->json('seo_tags')->nullable();
      $table->string('uuid', 36);
      $table->tinyInteger('online')->default(0);
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
    Schema::dropIfExists('courses');
  }
}
