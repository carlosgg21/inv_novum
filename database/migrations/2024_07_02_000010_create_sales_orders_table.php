<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->nullable();
            $table->string('prefix')->nullable();
            $table->date('order_date');
            $table->date('invoice_date')->nullable();
            $table
                ->enum('status', ['entered', 'not entered'])
                ->default('not entered');
            $table->float('taxes')->nullable();
            $table->float('discount')->nullable();
            $table->float('miscellaneous')->nullable();
            $table->float('freight')->nullable();
            $table->float('order_total')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('payment_term_id')->nullable();
            $table->text('notes')->nullable();
            $table->text('internal_notes')->nullable();
            $table->unsignedBigInteger('sold_by')->nullable();
            $table->string('approved_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
