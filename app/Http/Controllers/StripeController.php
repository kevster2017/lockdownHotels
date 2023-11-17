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

        $details = DB::table('cart')
            ->where('userId', $userId)
            ->first();

        return view('bookings.stripe', [
            'details' =>  $details
        ]);
    }

    public function stripePost(Request $request)
    {
        $user_id = auth()->user()->id;
        $cart = Cart::where('userId', $user_id)
            ->first();

        if (!$cart) {
            // Handle the case where the cart is not found
            return redirect()->back()->with('error', 'Cart not found');
        }


        $hotel = Hotel::find($cart->hotel_Id);

        if (!$hotel) {
            // Handle the case where the hotel is not found
            return redirect()->back()->with('error', 'Hotel not found');
        }

        // Validate the number of available rooms before decrementing
        if ($hotel->numRooms > 0) {
            $hotel->decrement('numRooms');
        } else {
            // Handle the case where the number of available rooms is already 0
            return redirect()->back()->with('error', 'No available rooms');
        }

        $total = $cart->price;

        $hotel = $cart->name;


        // Total is in pence. Multiply by 100 for £1
        $total = ($total * 100);


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $total,
            "currency" => "GBP",
            "source" => $request->stripeToken,
            "description" => "This payment is for {{$hotel}}",
        ]);

        // Decrement number of available hotel rooms

        Cart::where('userId', $user_id)->delete();

        return view('home')->with('success', 'Booking Completed');
    }
}
