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
        Schema::create('typecredits', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['don', 'credit']); // type principal
            $table->string('title'); // titre
            $table->text('description')->nullable();
            $table->decimal('max_amount', 12, 2)->nullable(); // montant max
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typecredits');
    }
};
