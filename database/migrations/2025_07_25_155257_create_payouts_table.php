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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('instructor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->unsignedBigInteger('payment_id')->nullable(); // null si el pago fue manual

            $table->decimal('total_payment', 10, 2);
            $table->decimal('instructor_amount', 10, 2);
            $table->decimal('platform_amount', 10, 2);

            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->timestamp('payout_date')->nullable();
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
        Schema::dropIfExists('payouts');
    }
};
