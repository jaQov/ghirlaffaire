<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign keys
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            $table->foreignId('commune_id')
                ->constrained('communes')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            // Order details
            $table->integer('quantity')->default(1); // Quantity of product

            $table->integer('total_price'); // Total price (Product price + Delivery fee)

            $table->string('ip_address'); // Storing client's IP address

            // Delivery method
            $table->enum('delivery_method', ['Door', 'StopDesk']);

            $table->text('note')->nullable(); // Additional notes about the order

            // Order status with default value
            $table->enum('status', ['Pending', 'Confirmed', 'Canceled', 'Shipped', 'Delivered', 'Returned'])->nullable();


            $table->timestamps(); // Created at & Updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
