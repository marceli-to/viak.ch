<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCourseTableRenameFactsColumns extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('courses', function (Blueprint $table) {
      $table->renameColumn('facts_content', 'facts_column_1');
      $table->renameColumn('facts_requirements', 'facts_column_2');
      $table->renameColumn('facts_courses', 'facts_column_3');
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
      $table->renameColumn('facts_column_1', 'facts_content');
      $table->renameColumn('facts_column_2', 'facts_requirements');
      $table->renameColumn('facts_column_3', 'facts_courses');
    });
  }
}
