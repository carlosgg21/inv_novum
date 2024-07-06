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
        Schema::table('payments_receiveds', function (Blueprint $table) {
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
                ->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sales_order_id')
                ->references('id')
                ->on('sales_orders')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('received_id')
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
        Schema::table('payments_receiveds', function (Blueprint $table) {
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['payment_term_id']);
            $table->dropForeign(['invoice_id']);
            $table->dropForeign(['sales_order_id']);
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['received_id']);
        });
    }
};
