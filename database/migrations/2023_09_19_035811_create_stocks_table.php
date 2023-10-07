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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('code_stock');
            $table->string('name_stock');
            $table->string('unit');
            $table->string('packaging');
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(['code_stock', 'branch_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
