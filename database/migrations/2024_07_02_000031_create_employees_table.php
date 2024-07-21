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
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identification');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->date('hiring_date')->nullable();
            $table->date('discharge_date')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->date('birthday')->nullable();
            $table->text('observation')->nullable();
            $table->unsignedBigInteger('charge_id')->nullable();
            $table->string('qr_code')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
