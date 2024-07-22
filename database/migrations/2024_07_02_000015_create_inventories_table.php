<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('quantity_on_order')->nullable();
            $table->float('sell_price')->nullable();
            $table->float('cost_price')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('batch_number')->nullable();
            $table->date('expire_date')->nullable();
            $table->float('shipping_cost')->nullable();
            $table->string('shipping_tracking_number')->nullable();                        
            $table->date('received_date')->nullable();
            $table->boolean('billable')->default(0); //pagado 0 NO  1 YES
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('payment_term_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();            
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
