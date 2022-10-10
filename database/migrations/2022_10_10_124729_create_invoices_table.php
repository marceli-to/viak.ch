<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('invoices', function (Blueprint $table) {
      $table->id();
      $table->string('number', 6);
      $table->date('date');
      $table->decimal('total', 8, 2)->default(0.00);
      $table->decimal('discount', 8, 2)->nullable()->default(0.00);
      $table->decimal('vat', 8, 2)->default(0.00);
      $table->decimal('grand_total', 8, 2)->default(0.00);
      $table->string('filename', 255)->nullable();
      $table->text('invoice_address')->nullable();
      $table->text('cancel_reason')->nullable();
      $table->tinyInteger('cancelled')->default(0);
      $table->tinyInteger('paid')->default(0);
      $table->string('uuid', 36);
      $table->foreignId('booking_id')->nullable()->constrained();
      $table->foreignId('user_id')->nullable()->constrained();
      $table->timestamp('paid_at')->nullable();
      $table->timestamp('cancelled_at')->nullable();
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
    Schema::dropIfExists('invoices');
  }
}
