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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->integer('passenger_count');
            $table->json('selected_seats');
            $table->decimal('total_price', 10, 2);
            $table->string('coupon_code')->nullable();
            $table->string('payment_method');
            $table->string('sender_number')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('booking_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
