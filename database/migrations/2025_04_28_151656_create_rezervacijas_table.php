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
        Schema::create('rezervacijas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sto_id')->constrained('stos'); // povezuje se automatski na stos.id
            $table->foreignId('gost_id')->constrained('gosts'); // povezuje se automatski na gosts.id
            $table->dateTime('vreme');
            $table->boolean('potvrdjeno');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rezervacijas');
    }
};
