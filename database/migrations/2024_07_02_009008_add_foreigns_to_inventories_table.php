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
        Schema::table('inventories', function (Blueprint $table) {
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

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
                 ->foreign('created_by')
                 ->references('id')
                 ->on('employees')
                 ->onUpdate('CASCADE')
                 ->onDelete('CASCADE');
           
             $table
                 ->foreign('unit_id')
                 ->references('id')
                 ->on('units')
                 ->onUpdate('CASCADE')
                 ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['payment_method_id']);
            $table->dropForeign(['payment_term_id']);
            $table->dropForeign(['created_by']);            
            $table->dropForeign(['unit_id']);

        });
    }
};
