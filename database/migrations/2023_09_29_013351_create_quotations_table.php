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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('code_quotation')->unique();
            $table->foreignId('prospect_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('no_sp');
            $table->enum('category_quotation', ['Franco', 'Loco']);
            $table->date('date_quotation');
            $table->string('payment');
            $table->enum('status_quotation', ['Draf', 'Progress', 'Done'])->default('Draf');
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
        Schema::dropIfExists('quotations');
    }
};
