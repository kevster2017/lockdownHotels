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
            $table->integer('stars');
            $table->string('feat1');
            $table->string('feat2');
            $table->string('feat3');
            $table->string('feat4');
            $table->integer('feat1Price');
            $table->integer('feat2Price');
            $table->integer('feat3Price');
            $table->integer('feat4Price');
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
            $table->integer('numRooms');
            $table->string('description');
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
