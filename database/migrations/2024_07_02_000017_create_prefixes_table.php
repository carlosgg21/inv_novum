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
        Schema::create('prefixes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('display')->nullable();
            $table->text('description')->nullable();
            $table->string('used_in')->nullable();
            $table->integer('star_number')->nullable();
            $table
                ->integer('position')
                ->default(0)
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefixes');
    }
};
