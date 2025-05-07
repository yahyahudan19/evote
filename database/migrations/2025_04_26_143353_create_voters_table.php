<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('id_card_number')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('birth_date');
            $table->string('code')->unique();
            $table->enum('status', ['not_voted', 'voted'])->default('not_voted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voters');
    }
};
