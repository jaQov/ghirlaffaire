<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('delivery_prices', function (Blueprint $table) {
            $table->unsignedInteger('wilaya_code'); // Part of Composite PK
            $table->unsignedInteger('company_id'); // Part of Composite PK

            // Explicitly Name Foreign Keys to Avoid Conflicts
            $table->foreign('wilaya_code', 'fk_delivery_prices_wilaya')
                ->references('wilaya_code')->on('wilayas')
                ->onDelete('cascade');

            $table->foreign('company_id', 'fk_delivery_prices_company')
                ->references('id')->on('delivery_companies')
                ->onDelete('cascade');

            // Other Fields
            $table->integer('door')->default(0);
            $table->integer('stopdesk')->default(0);
            $table->timestamps();

            // Set Composite Primary Key
            $table->primary(['wilaya_code', 'company_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_prices');
    }
};
