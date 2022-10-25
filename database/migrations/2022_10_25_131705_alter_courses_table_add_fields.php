<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCoursesTableAddFields extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('courses', function (Blueprint $table) {
      $table->renameColumn('text', 'short_description');
    });

    Schema::table('courses', function (Blueprint $table) {
      $table->json('full_description')->nullable()->after('short_description');
      $table->json('additional_information')->nullable()->after('full_description');
      $table->json('facts_content')->nullable()->after('additional_information');
      $table->json('facts_requirements')->nullable()->after('facts_content');
      $table->json('facts_courses')->nullable()->after('facts_requirements');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('courses', function (Blueprint $table) {
      $table->renameColumn('short_description', 'text');
    });

    Schema::table('courses', function (Blueprint $table) {
      $table->dropColumn('full_description');
      $table->dropColumn('additional_information');
      $table->dropColumn('facts_content');
      $table->dropColumn('facts_requirements');
      $table->dropColumn('facts_courses');
    });
  }
}
