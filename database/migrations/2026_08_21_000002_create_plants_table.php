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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->integer('stock')->default(10);
            $table->integer('rating')->default(5);
            $table->string('location')->default('Phnom Penh');
            $table->string('light_level')->default('Medium Indirect Light');
            $table->string('water_frequency')->default('Every 7 Days');
            $table->boolean('is_pet_friendly')->default(true);
            $table->boolean('is_featured')->default(true);
            $table->string('badge')->nullable(); // e.g. Best Seller, Popular, Easy Care
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
