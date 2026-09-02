<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealovi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tvrtka_id')->constrained('tvrtke')->cascadeOnDelete();
            $table->foreignId('kontakt_id')->nullable()->constrained('kontakti')->nullOnDelete();
            $table->string('naziv');
            $table->decimal('vrijednost', 12, 2)->default(0.00);
            $table->string('status')->default('lead'); // lead, kvalificiran, ponuda, dobiveno, izgubljeno
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealovi');
    }
};
