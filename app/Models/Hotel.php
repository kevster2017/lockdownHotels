<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'userId',
        'name',
        'image',
        'address',
        'town',
        'country',
        'postCode',
        'accomType',
        'roomType',
        'holidayType',
        'stars',
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
        'price',
        'numRooms',
        'description',
        'agreeTerms'
    ];
    // Hotel belongs to a user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hotel belongs to a booking relationship
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}
