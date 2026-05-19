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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();

            $table->foreignId('credit_social_id')
                ->constrained('creditsocials')
                ->cascadeOnDelete();

            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('amount', 12, 2);

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->decimal('amount_retenu', 12, 2)->nullable();

            $table->integer('duration')->nullable();

            $table->enum('state', ['draft', 'inprogress', 'done'])
                ->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};
