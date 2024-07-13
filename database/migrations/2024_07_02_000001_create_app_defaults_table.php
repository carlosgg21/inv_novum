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
        Schema::create('app_defaults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('module');
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->text('value');
            $table->text('description')->nullable();
            $table->boolean('manager_by')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_defaults');
    }
};
