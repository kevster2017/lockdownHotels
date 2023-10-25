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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('userId');
            $table->date('checkIn');
            $table->integer('nights');
            $table->string('hotelName');
            $table->string('address');
            $table->string('postCode');
            $table->string('accomType');
            $table->string('roomType');
            $table->integer('numRooms');
            $table->integer('pricePN');
            $table->string('upgrade');
            $table->string('package');
            $table->string('extras');
            $table->string('customHol');
            $table->string('currency');
            $table->integer('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
