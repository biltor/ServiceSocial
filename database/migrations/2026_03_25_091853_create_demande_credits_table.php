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
        Schema::create('demande_credits', function (Blueprint $table) {
            $table->id();

            $table->string('reference')->unique();
            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('date_demande')->nullable();

            $table->foreignId('type_credit_id')
                ->nullable()
                ->constrained('typecredits')
                ->nullOnDelete();

            $table->decimal('montant', 12, 2)->default(0);

            $table->text('motif');

            $table->enum('etat', ['brouillon', 'valide', 'refuse'])
                ->default('brouillon');

            $table->string('attachment')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_credits');
    }
};
