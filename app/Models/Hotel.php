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
        'postCode',
        'accomType',
        'roomType',
        'holidayType',
        'currency',
        'price',
        'numRooms',
        'description',
        'payopts',
        'agreeTerms'
    ];
    // Hotel belongs to a user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
