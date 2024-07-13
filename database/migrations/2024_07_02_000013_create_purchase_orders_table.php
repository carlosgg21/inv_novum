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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->nullable();
            $table->date('order_date');
            $table->float('total_amount');
            $table->string('prefix')->nullable();
            $table
                ->enum('status', ['entered', 'not entered'])
                ->default('not entered');
            $table->unsignedBigInteger('supplier_id');
            $table->float('taxes')->nullable();
            $table->float('discount')->nullable();
            $table->float('miscellaneous')->nullable();
            $table->date('shipping_date')->nullable();
            $table->float('shipping_cost')->nullable();
            $table->string('shippin_tracking_number')->nullable();
            $table->date('received_date')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('payment_term_id')->nullable();
            $table->unsignedBigInteger('condition_id');
            $table->boolean('billable')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
