<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->string('company', 255)->after('name')->nullable();
        $table->string('street', 255)->nullable()->after('company');
        $table->string('street_no', 15)->nullable()->after('street');
        $table->string('zip', 15)->nullable()->after('street_no');
        $table->string('city', 255)->nullable()->after('zip');
        $table->string('phone', 45)->nullable()->after('city');
        $table->tinyInteger('has_invoice_address')->nullable()->default(0)->after('phone');
        $table->text('expert_title')->nullable()->after('has_invoice_address');
        $table->text('expert_description')->nullable()->after('expert_title');
        $table->text('expert_bio')->nullable()->after('expert_description');
        $table->string('operating_system', 255)->nullable()->after('expert_bio');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('company');
        $table->dropColumn('street');
        $table->dropColumn('street_no');
        $table->dropColumn('zip');
        $table->dropColumn('city');
        $table->dropColumn('phone');
        $table->dropColumn('has_invoice_address');
        $table->dropColumn('expert_title');
        $table->dropColumn('expert_description');
        $table->dropColumn('expert_bio');
        $table->dropColumn('operating_system');
      });
    }
}
