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
        Schema::create('introductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prospect_id')->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date_introduction');
            $table->enum('status_introduction', ['Progress', 'Done'])->default('Progress');
            $table->text('remark');
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('introductions');
    }
};
