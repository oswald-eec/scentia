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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');       // Comprador
            $table->unsignedBigInteger('course_id');     // Curso comprado
            $table->string('hotmart_transaction_id')->unique();    // ID de la transacción en Hotmart
            $table->enum('status', ['pending', 'completed', 'refunded'])->default('pending');
            $table->decimal('price_paid', 8, 2);
            $table->timestamp('purchased_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
