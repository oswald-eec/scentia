<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // comprador
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); // curso comprado

            $table->enum('method', ['mercadopago', 'airtm', 'redenlace', 'libelula']);
            $table->string('transaction_id')->nullable(); // ID en la pasarela (si aplica)
            $table->decimal('amount', 10, 2); // monto pagado
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('proof_url')->nullable();

            $table->timestamp('paid_at')->nullable(); // solo cuando esté pagado

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
