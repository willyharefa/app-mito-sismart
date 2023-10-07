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
        Schema::create('negotiations', function (Blueprint $table) {
            $table->id();
            $table->string('code_negotiation')->unique();
            $table->foreignId('prospect_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date_negotiation');
            $table->enum('status_negotiation', ['Progress', 'Done'])->default('Progress');
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
        Schema::dropIfExists('negotiations');
    }
};
