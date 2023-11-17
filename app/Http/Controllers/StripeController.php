<?php

namespace App\Http\Controllers;


use Stripe;
use App\Models\Cart;
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



        $total = $cart->price;

        $hotel = $cart->name;

        // Total is in pence. Multiply by 100 for £1, multiply by 1000 for £10
        $total = ($total * 100) + 1000;


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $total,
            "currency" => "GBP",
            "source" => $request->stripeToken,
            "description" => "This payment is for {{$hotel}}",
        ]);

        Cart::where('userId', $user_id)->delete();
        return view('bookings.complete')->with('success', 'Booking Completed');
    }
}
