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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('code_deal')->unique();
            $table->foreignId('prospect_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('quotation_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date_deal');
            $table->string('no_po')->unique();
            $table->text('remark');
            $table->enum('status_deal', ['Progress', 'Done'])->default('Progress');
            $table->foreignId('branch_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
