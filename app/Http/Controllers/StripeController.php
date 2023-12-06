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


        if (!$cart) {
            // Handle the case where the cart is not found
            return redirect()->back()->with('error', 'Cart not found');
        }


        // Set hotel name for Stripe Charge
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

        /* Create a new Booking */
        $bookings = new Booking;

        $bookings->userId = $cart->userId;
        $bookings->name = $cart->name;
        $bookings->hotel_Id = $cart->hotel_Id;
        $bookings->image = $cart->image;
        $bookings->address = $cart->address;
        $bookings->town = $cart->town;
        $bookings->postCode = $cart->postCode;
        $bookings->country = $cart->country;
        $bookings->accomType = $cart->accomType;
        $bookings->roomType = $cart->roomType;
        $bookings->holidayType = $cart->holidayType;
        $bookings->price = $cart->price;
        $bookings->checkInDate = $cart->checkInDate;
        $bookings->numNights = $cart->numNights;
        $bookings->feat1 = $cart->feat1;
        $bookings->feat2 = $cart->feat2;
        $bookings->feat3 = $cart->feat3;
        $bookings->feat4 = $cart->feat4;
        $bookings->feat1Price = $cart->feat1Price;
        $bookings->feat2Price = $cart->feat2Price;
        $bookings->feat3Price = $cart->feat3Price;
        $bookings->feat4Price = $cart->feat4Price;
        $bookings->selectedFeat1 = $cart->selectedFeat1;
        $bookings->selectedFeat2 = $cart->selectedFeat2;
        $bookings->selectedFeat3 = $cart->selectedFeat3;
        $bookings->selectedFeat4 = $cart->selectedFeat4;
        $bookings->featuresTotal = $cart->featuresTotal;
        $bookings->upgrade1 = $cart->upgrade1;
        $bookings->upgrade2 = $cart->upgrade2;
        $bookings->upgrade3 = $cart->upgrade3;
        $bookings->upgrade1Price = $cart->upgrade1Price;
        $bookings->upgrade2Price = $cart->upgrade2Price;
        $bookings->upgrade3Price = $cart->upgrade3Price;
        $bookings->selectedUpgrade = $cart->selectedUpgrade;
        $bookings->upgradeTotal = $cart->upgradeTotal;
        $bookings->package1 = $cart->package1;
        $bookings->package2 = $cart->package2;
        $bookings->package3 = $cart->package3;
        $bookings->package1Price = $cart->package1Price;
        $bookings->package2Price = $cart->package2Price;
        $bookings->package3Price = $cart->package3Price;
        $bookings->selectedPackage = $cart->selectedPackage;
        $bookings->packageTotal = $cart->packageTotal;
        $bookings->currency = $cart->currency;
        $bookings->extrasTotal = $cart->extrasTotal;
        $bookings->finalTotal = $cart->finalTotal;
        $bookings->payment_method = 'Stripe';
        $bookings->paid = 1;


        $bookings->save();



        Cart::where('userId', $userId)->delete();

        return view('/booking/myBookings')->with('success', 'Booking Completed');
    }
}
