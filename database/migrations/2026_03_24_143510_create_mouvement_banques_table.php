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
        Schema::create('mouvement_banques', function (Blueprint $table) {
            $table->id();

            $table->string('reference')->nullable();

            $table->enum('type', ['credit', 'debit']); // sens du mouvement

            $table->decimal('amount', 12, 2);

            $table->string('description')->nullable();

            $table->date('date');

            $table->foreignId('credit_social_id')
                ->nullable()
                ->constrained('creditsocials')
                ->nullOnDelete();
            $table->foreignId('virement_id')
                ->nullable()
                ->constrained('virementbcs') //  CORRECT
                ->nullOnDelete();
            $table->decimal('balance', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_banques');
    }
};
