<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');        // Contact's name
            $table->string('email');       // Contact's email address
            $table->string('phone')->nullable(); // Contact's phone number (optional)
            $table->text('message');       // The message from the contact form
            $table->boolean('status'); // Status of the contact (positive or negative)
            $table->timestamps();          // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
}
