<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Client name
            $table->string('phone')->unique(); // Unique phone number
            $table->integer('total_orders')->default(0); // Total number of orders
            $table->integer('amount_spent')->default(0); // Total amount spent
            $table->ipAddress('ip_address')->nullable(); // Client's IP address (nullable)
            $table->text('note')->nullable(); // Additional notes about the client

            // Foreign Key for Last Order ID (Nullable Initially)
            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->nullOnDelete(); // If order is deleted, set this to NULL

            $table->timestamps(); // Created at & Updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
