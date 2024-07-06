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
        Schema::table('payment_mades', function (Blueprint $table) {
            $table
                ->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('payment_term_id')
                ->references('id')
                ->on('payment_terms')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('purchase_order_id')
                ->references('id')
                ->on('purchase_orders')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('created_by')
                ->references('id')
                ->on('employees')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_mades', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['payment_term_id']);
            $table->dropForeign(['purchase_order_id']);
            $table->dropForeign(['created_by']);
        });
    }
};
