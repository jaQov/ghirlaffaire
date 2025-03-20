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
        Schema::create('wilayas', function (Blueprint $table) {
            $table->unsignedInteger('wilaya_code')->primary(); // Ensure it's unsigned
            $table->string('wilaya_name_ar');
            $table->string('wilaya_name_fr');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('wilayas');
    }
};
