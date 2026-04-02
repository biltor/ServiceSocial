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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unite_id')->constrained()->cascadeOnDelete();
            $table->integer('matricule');
            $table->string('name');
            $table->string('name_ar');
            $table->string('last_name');
            $table->string('last_name_ar');
            $table->enum('sex', ['Femme', 'Homme'])->default('Homme');
            $table->string('nin');
            $table->string('tel');
            $table->string('post');
            $table->string('bank_name')->nullable();
            $table->string('compte_bank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('employees');
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('employees');

        Schema::enableForeignKeyConstraints();
    }
};
