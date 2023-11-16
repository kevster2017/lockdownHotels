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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('hotel_Id');
            $table->integer('userId');
            $table->string('name');
            $table->string('image');
            $table->string('address');
            $table->string('town');
            $table->string('country');
            $table->string('postCode');
            $table->string('accomType');
            $table->string('roomType');
            $table->string('holidayType');
            $table->string('feat1')->default("None");
            $table->string('feat2')->default("None");
            $table->string('feat3')->default("None");
            $table->string('feat4')->default("None");
            $table->integer('feat1Price')->default(0);
            $table->integer('feat2Price')->default(0);
            $table->integer('feat3Price')->default(0);
            $table->integer('feat4Price')->default(0);
            $table->string('upgrade1');
            $table->string('upgrade2');
            $table->string('upgrade3');
            $table->integer('upgrade1Price');
            $table->integer('upgrade2Price');
            $table->integer('upgrade3Price');
            $table->string('package1');
            $table->string('package2');
            $table->string('package3');
            $table->integer('package1Price');
            $table->integer('package2Price');
            $table->integer('package3Price');
            $table->string('currency');
            $table->integer('price');
            $table->date('checkInDate');
            $table->integer('numNights');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
