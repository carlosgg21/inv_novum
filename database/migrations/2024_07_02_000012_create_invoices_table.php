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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->string('number')
                ->default('str')
                ->nullable();
            $table->decimal('total_amount')->nullable();
            $table->date('date');
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('sales_order_id');
            $table->string('prefix')->nullable();
            $table->string('status');
            $table->string('year')->nullable();
            $table->integer('month')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
