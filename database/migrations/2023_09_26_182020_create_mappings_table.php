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
        Schema::create('mappings', function (Blueprint $table) {
            $table->id();
            $table->string('code_mapping')->unique();
            $table->foreignId('prospect_id')->unique()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date_mapping');
            $table->enum('status_mapping', ['Progress', 'Done'])->default('Progress');
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
        Schema::dropIfExists('mappings');
    }
};
