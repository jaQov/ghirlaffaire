<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete(); // Foreign key referencing `clients.id`

            $table->foreignId('commune_id')
                ->constrained('communes')
                ->cascadeOnDelete(); // Foreign key referencing `communes.id`

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete(); // Foreign key referencing `products.id`

            $table->integer('quantity')->default(1); // Quantity of product
            $table->enum('delivery_method', ['Door', 'StopDesk']); // Delivery method
            $table->enum('Status', ['Pending', 'Confirmed', 'Canceled', 'Delivered'])->nullable();
            $table->integer('total_price'); // Total price
            $table->timestamps(); // Created at & Updated at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
