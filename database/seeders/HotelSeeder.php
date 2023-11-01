<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Hotel::create(['userId' => 1, 'name' => 'Europa Hotel', 'image' => 'uploads/h5G1ioc41AjcbHPpqN0AdLaDeeSQTjnp2Bfk7kE6.jpg', 'address' => 'Gt Victoria Street', 'town' => 'Belfast', 'country' => 'N. Ireland', 'postCode' => 'BT1 1XX', 'accomType' => 'Hotel', 'roomType' => 'Single', 'holidayType' => 'City Break', 'feat1' => 'Add breakfast', 'feat2' => 'Add dinner', 'feat3' => 'Add lunch', 'feat4' => 'Add activity', 'feat1Price' => 10, 'feat2Price' => 20, 'feat3Price' => 15, 'feat4Price' => 20, 'upgrade1' => 'Penthouse Suite', 'upgrade2' => 'Add Balcony', 'upgrade3' => 'Large Room', 'upgrade1price' => 100, 'upgrade2price' => 150, 'upgrade3price' => 100, 'package1' => 'Bridal Package', 'package2' => 'Family Package', 'package3' => 'Unlimited Drinks', 'package1price' => 300, 'package2price' => 200, 'package3price' => 100, 'currency' => 'Sterling', 'price' => 200, 'numRooms' => 3]);

        Hotel::create(['userId' => 1, 'name' => 'Amsterdam Beach Hotel', 'image' => 'uploads/h5G1ioc41AjcbHPpqN0AdLaDeeSQTjnp2Bfk7kE6.jpg', 'address' => '1a Main Street', 'town' => 'Zandvoort', 'country' => 'Netherlands', 'postCode' => 'ZN1 1XX', 'accomType' => 'Hotel', 'roomType' => 'Single', 'holidayType' => 'Seaside Resort', 'feat1' => 'Add breakfast', 'feat2' => 'Add dinner', 'feat3' => 'Add lunch', 'feat4' => 'Add activity', 'feat1Price' => 10, 'feat2Price' => 20, 'feat3Price' => 15, 'feat4Price' => 20, 'upgrade1' => 'Penthouse Suite', 'upgrade2' => 'Add Balcony', 'upgrade3' => 'Large Room', 'upgrade1price' => 100, 'upgrade2price' => 150, 'upgrade3price' => 100, 'package1' => 'Bridal Package', 'package2' => 'Family Package', 'package3' => 'Unlimited Drinks', 'package1price' => 300, 'package2price' => 200, 'package3price' => 100, 'currency' => 'Sterling', 'price' => 200, 'numRooms' => 3]);

        Hotel::create(['userId' => 1, 'name' => 'Lake of Shadows', 'image' => 'uploads/h5G1ioc41AjcbHPpqN0AdLaDeeSQTjnp2Bfk7kE6.jpg', 'address' => '1a Main Street', 'town' => 'Buncrana', 'country' => 'Ireland', 'postCode' => 'BN1 1XX', 'accomType' => 'Hotel', 'roomType' => 'Triple', 'holidayType' => 'Country Escape', 'feat1' => 'Add breakfast', 'feat2' => 'Add dinner', 'feat3' => 'Add lunch', 'feat4' => 'Add activity', 'feat1Price' => 10, 'feat2Price' => 20, 'feat3Price' => 15, 'feat4Price' => 20, 'upgrade1' => 'Penthouse Suite', 'upgrade2' => 'Add Balcony', 'upgrade3' => 'Large Room', 'upgrade1price' => 100, 'upgrade2price' => 150, 'upgrade3price' => 100, 'package1' => 'Bridal Package', 'package2' => 'Family Package', 'package3' => 'Unlimited Drinks', 'package1price' => 300, 'package2price' => 200, 'package3price' => 100, 'currency' => 'Sterling', 'price' => 400, 'numRooms' => 3]);

        Hotel::create(['userId' => 1, 'name' => 'Slieve Donard', 'image' => 'uploads/h5G1ioc41AjcbHPpqN0AdLaDeeSQTjnp2Bfk7kE6.jpg', 'address' => 'Gt Victoria Street', 'town' => 'Newcastle', 'country' => 'N. Ireland', 'postCode' => 'NW1 1XX', 'accomType' => 'Hotel', 'roomType' => 'Double', 'holidayType' => 'Seaside Resort', 'feat1' => 'Add breakfast', 'feat2' => 'Add dinner', 'feat3' => 'Add lunch', 'feat4' => 'Add activity', 'feat1Price' => 10, 'feat2Price' => 20, 'feat3Price' => 15, 'feat4Price' => 20, 'upgrade1' => 'Penthouse Suite', 'upgrade2' => 'Add Balcony', 'upgrade3' => 'Large Room', 'upgrade1price' => 100, 'upgrade2price' => 150, 'upgrade3price' => 100, 'package1' => 'Bridal Package', 'package2' => 'Family Package', 'package3' => 'Unlimited Drinks', 'package1price' => 300, 'package2price' => 200, 'package3price' => 100, 'currency' => 'Sterling', 'price' => 300, 'numRooms' => 1]);

        Hotel::create(['userId' => 1, 'name' => 'Sunset Beach Club', 'image' => 'uploads/h5G1ioc41AjcbHPpqN0AdLaDeeSQTjnp2Bfk7kE6.jpg', 'address' => '1a Main Street', 'town' => 'Benalmadena', 'country' => 'Spain', 'postCode' => 'ZN1 1XX', 'accomType' => 'Hotel', 'roomType' => 'Twin', 'holidayType' => 'Seaside Resort', 'feat1' => 'Add breakfast', 'feat2' => 'Add dinner', 'feat3' => 'Add lunch', 'feat4' => 'Add activity', 'feat1Price' => 10, 'feat2Price' => 20, 'feat3Price' => 15, 'feat4Price' => 20, 'upgrade1' => 'Penthouse Suite', 'upgrade2' => 'Add Balcony', 'upgrade3' => 'Large Room', 'upgrade1price' => 100, 'upgrade2price' => 150, 'upgrade3price' => 100, 'package1' => 'Bridal Package', 'package2' => 'Family Package', 'package3' => 'Unlimited Drinks', 'package1price' => 300, 'package2price' => 200, 'package3price' => 100, 'currency' => 'Sterling', 'price' => 250, 'numRooms' => 8]);

        Hotel::create(['userId' => 1, 'name' => 'Cyprus Villa', 'image' => 'uploads/h5G1ioc41AjcbHPpqN0AdLaDeeSQTjnp2Bfk7kE6.jpg', 'address' => '1a Main Street', 'town' => 'Buncrana', 'country' => 'Ireland', 'postCode' => 'BN1 1XX', 'accomType' => 'Villa', 'roomType' => 'Family Room', 'holidayType' => 'Country Escape', 'feat1' => 'Add breakfast', 'feat2' => 'Add dinner', 'feat3' => 'Add lunch', 'feat4' => 'Add activity', 'feat1Price' => 10, 'feat2Price' => 20, 'feat3Price' => 15, 'feat4Price' => 20, 'upgrade1' => 'Penthouse Suite', 'upgrade2' => 'Add Balcony', 'upgrade3' => 'Large Room', 'upgrade1price' => 100, 'upgrade2price' => 150, 'upgrade3price' => 100, 'package1' => 'Bridal Package', 'package2' => 'Family Package', 'package3' => 'Unlimited Drinks', 'package1price' => 300, 'package2price' => 200, 'package3price' => 100, 'currency' => 'Sterling', 'price' => 300, 'numRooms' => 3]);
    }
}
