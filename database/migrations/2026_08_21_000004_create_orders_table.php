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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('payment_method')->default('COD'); // COD, KHQR, ABA
            $table->string('payment_status')->default('Pending'); // Pending, Paid, Failed
            $table->string('order_status')->default('Pending'); // Pending, Processing, Shipped, Delivered, Cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
