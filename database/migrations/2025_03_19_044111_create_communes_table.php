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
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->string('commune_name_ar');
            $table->string('commune_name_fr');
            $table->unsignedInteger('wilaya_code'); // Ensure it's unsigned
            $table->foreign('wilaya_code', 'fk_tableName_wilaya')
                ->references('wilaya_code')
                ->on('wilayas')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('communes');
    }
};

