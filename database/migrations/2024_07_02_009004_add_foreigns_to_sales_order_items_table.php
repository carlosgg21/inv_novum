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
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table
                ->foreign('sales_order_id')
                ->references('id')
                ->on('sales_orders')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('inventory_id')
                ->references('id')
                ->on('inventories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table->dropForeign(['sales_order_id']);
            $table->dropForeign(['inventory_id']);
        });
    }
};
