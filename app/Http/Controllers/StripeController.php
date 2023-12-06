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

        $cart = Cart::where('userId', $userId)
            ->first();

        /*
        if (!$cart) {
            // Handle the case where the cart is not found
            return redirect()->back()->with('error', 'Cart not found');
        }
*/

        /* Create a new Booking */
        $booking = new Booking;

$booking->userId = $cart->userId;
$booking->name = $cart->name;
$booking->hotelId = $cart->hotelId;
$booking->image = $cart->image;
$booking->address = $cart->address;
$booking->postCode = $cart->postCode;
$booking->accomType = $cart->accomType;
$booking->roomType = $cart->roomType;
$booking->holidayType = $cart->holidayType;
$booking->price = $cart->price;
$booking->checkInDate = $cart->checkInDate;
$booking->numNights = $cart->numNights;
$booking->feat1 = $cart->feat1;
$booking->feat2 = $cart->feat2;
$booking->feat3 = $cart->feat3;
$booking->feat4 = $cart->feat4;
$booking->feat1Price = $cart->feat1Price;
$booking->feat2Price = $cart->feat2Price;
$booking->feat3Price = $cart->feat3Price;
$booking->feat4Price = $cart->feat4Price;
$booking->selectedFeat1 = $cart->selectedFeat1;
$booking->selectedFeat2 = $cart->selectedFeat2;
$booking->selectedFeat3 = $cart->selectedFeat3;
$booking->selectedFeat4 = $cart->selectedFeat4;
$booking->featuresTotal = $cart->featuresTotal;
$booking->upgrade1 = $cart->upgrade1;
$booking->upgrade2 = $cart->upgrade2;
$booking->upgrade3 = $cart->upgrade3;
$booking->upgrade1Price = $cart->upgrade1Price;
$booking->upgrade2Price = $cart->upgrade2Price;
$booking->upgrade3Price = $cart->upgrade3Price;
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->
$booking-> = $cart->



        $hotel = $cart->name;


        // Total is in pence. Multiply by 100 for £1
        $total = $cart->finalTotal * 100;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $total,
            "currency" => "GBP",
            "source" => $request->stripeToken,
            "description" => "This payment is for {$hotel}",
        ]);



        $bookings->paid = 1;
        $bookings->save();



        Cart::where('userId', $userId)->delete();

        return view('/home')->with('success', 'Booking Completed');
    }
}
