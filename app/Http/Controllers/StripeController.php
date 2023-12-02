<?php

namespace App\Http\Controllers;


use Stripe;
use App\Models\Cart;
use App\Models\Hotel;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripe()
    {
        $userId = auth()->user()->id;

        $cart = DB::table('cart')
            ->where('userId', $userId)
            ->first();

        return view('bookings.stripe', [
            'cart' =>  $cart
        ]);
    }

    public function stripePost(Request $request)
    {

        $userId = auth()->user()->id;

        $bookings = Booking::where('userId', $userId)
            ->first();

        /*
        if (!$bookings) {
            // Handle the case where the cart is not found
            return redirect()->back()->with('error', 'Booking not found');
        }
*/

        $hotel = Hotel::find($bookings->hotel_Id);

        /*
        // Validate the number of available rooms before decrementing
        if ($hotel->numRooms > 0) {
            $hotel->decrement('numRooms');
        } else {
            // Handle the case where the number of available rooms is already 0
            return redirect()->back()->with('error', 'No available rooms');
        }

*/

        $hotel = $bookings->name;

        // Total is in pence. Multiply by 100 for £1
        $total = $bookings->total * 100;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $total,
            "currency" => "GBP",
            "source" => $request->stripeToken,
            "description" => "This payment is for {$hotel}",
        ]);

        $bookings->paid = 1;
        $bookings->save();

        return view('/home')->with('success', 'Booking Completed');
    }
}
