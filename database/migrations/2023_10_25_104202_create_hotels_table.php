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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('userId');
            $table->string('name');
            $table->string('image');
            $table->string('address');
            $table->string('town');
            $table->string('country');
            $table->string('postCode');
            $table->string('accomType');
            $table->string('roomType');
            $table->string('holidayType');
            $table->string('hotelOptions');
            $table->string('currency');
            $table->integer('price');
            $table->integer('numRooms');
            $table->string('description');
            $table->string('payOpts');
            $table->boolean('agreeTerms')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
