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
        Schema::create('jartests', function (Blueprint $table) {
            $table->id();
            $table->string('code_jartest')->unique();
            $table->foreignId('prospect_id')->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('stock_id')->unique()->constrained()->cascadeOnUpdate()->cascadeOnUpdate();
            $table->date('date_jartest');
            $table->enum('status_jartest', ['Progress', 'Done'])->default('Progress');
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
        Schema::dropIfExists('jartests');
    }
};
