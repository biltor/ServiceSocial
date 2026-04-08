<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * les unités 
     */
    public function up(): void
    {
        Schema::create('creditsocials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('demande_credit_id')
                ->constrained('demande_credits')
                ->cascadeOnDelete();


            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->foreignId('type_credit_id')
                ->nullable()
                ->constrained('typecredits')
                ->nullOnDelete();

            $table->decimal('amount_accord', 12, 2);

            $table->decimal('amount_dema', 12, 2);

            $table->decimal('amout_retenu', 12, 2);

            $table->date('date_contrat')->nullable();

            $table->enum('type_payment', ['virement', 'cheque'])
                ->default('virement');
                //refference de payement
            $table->string('refpayement')->nullable();

            $table->date('date_retenu')->nullable();


            $table->enum('state', ['nouveau', 'en progression', 'terminer'])
                ->default('nouveau');


            $table->string('account_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditsocials');
    }
};
