<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ponude', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deal_id')->constrained('dealovi')->cascadeOnDelete();
            $table->string('broj_ponude')->unique();
            $table->decimal('ukupni_iznos', 12, 2)->default(0.00);
            $table->string('status')->default('nacrt'); // nacrt, poslano, prihvaceno, odbijeno
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ponude');
    }
};
