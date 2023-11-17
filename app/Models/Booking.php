<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [

        'checkInDate',
        'numNights',
        'town',
        'country',
        'postCode',
        'accomType',
        'roomType',
        'holidayType',
        'feat1',
        'feat2',
        'feat3',
        'feat4',
        'feat1Price',
        'feat2Price',
        'feat3Price',
        'feat4Price',
        'upgrade1',
        'upgrade2',
        'upgrade3',
        'upgrade1Price',
        'upgrade2Price',
        'upgrade3Price',
        'package1',
        'package2',
        'package3',
        'package1Price',
        'package2Price',
        'package3Price',
        'currency',
        'pricePN',
        'numRooms',

    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
