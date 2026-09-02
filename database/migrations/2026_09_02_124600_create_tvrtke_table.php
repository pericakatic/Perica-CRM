<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tvrtke', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('email')->nullable();
            $table->string('telefon')->nullable();
            $table->string('adresa')->nullable();
            $table->string('status')->default('prospekt'); // prospekt, aktivna, neaktivna
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tvrtke');
    }
};
