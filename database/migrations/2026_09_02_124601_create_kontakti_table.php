<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontakti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tvrtka_id')->nullable()->constrained('tvrtke')->nullOnDelete();
            $table->string('ime');
            $table->string('prezime');
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
            $table->string('status')->default('lead'); // lead, kontaktiran, kupac
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontakti');
    }
};
