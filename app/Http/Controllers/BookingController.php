<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */


    public function addToCart(Request $request)
    {

        /* Create new Cart, pass request details to the $cart variables */
        $cart = new Cart;
        $cart->userId = auth()->user()->id;
        $cart->hotel_Id = $request->hotel_Id;
        $cart->name = $request->hotelName;
        $cart->image = $request->image;
        $cart->address = $request->address;
        $cart->town = $request->town;
        $cart->country = $request->country;
        $cart->postCode = $request->postCode;
        $cart->accomType = $request->accomType;
        $cart->roomType = $request->roomType;
        $cart->holidayType = $request->holidayType;
        $cart->stars = $request->stars;
        $cart->feat1 = $request->feat1;
        $cart->feat2 = $request->feat2;
        $cart->feat3 = $request->feat3;
        $cart->feat4 = $request->feat4;
        $cart->feat1Price = $request->feat1Price;
        $cart->feat2Price = $request->feat2Price;
        $cart->feat3Price = $request->feat3Price;
        $cart->feat4Price = $request->feat4Price;
        $cart->selectedFeat1 = $request->selectedFeat1;
        $cart->selectedFeat2 = $request->selectedFeat2;
        $cart->selectedFeat3 = $request->selectedFeat3;
        $cart->selectedFeat4 = $request->selectedFeat4;
        $cart->featuresTotal = $request->featuresTotal;
        $cart->upgrade1 = $request->upgrade1;
        $cart->upgrade2 = $request->upgrade2;
        $cart->upgrade3 = $request->upgrade3;
        $cart->upgrade1Price = $request->upgrade1Price;
        $cart->upgrade2Price = $request->upgrade2Price;
        $cart->upgrade3Price = $request->upgrade3Price;
        $cart->selectedUpgrade = $request->selectedUpgrade;
        $cart->upgradeTotal = $request->upgradeTotal;
        $cart->package1 = $request->package1;
        $cart->package2 = $request->package2;
        $cart->package3 = $request->package3;
        $cart->package1Price = $request->package1Price;
        $cart->package2Price = $request->package2Price;
        $cart->package3Price = $request->package3Price;
        $cart->selectedPackage = $request->selectedPackage;
        $cart->packageTotal = $request->packageTotal;
        $cart->extrasTotal = $request->extrasTotal;
        $cart->finalTotal = $request->finalTotal;
        $cart->currency = $request->currency;
        $cart->price =  $request->price;
        $cart->checkInDate = Carbon::createFromFormat('Y-m-d', $request->checkInDate);
        $cart->numNights = $request->numNights;

        /* Save details to the Cart */
        $cart->save();


        return redirect('/bookings/viewCart')->with('success', 'Booking Updated');
    }

    public function viewCart()
    {

        // Get auth userID
        $userId = auth()->user()->id;

        // Find userID in the Cart
        $cart = Cart::where('userId', $userId)
            ->first();

        // Check if the cart is empty, return cart if not empty
        if ($cart === null) {
            return back()->with('error', 'No items in cart');
        } else {

            return view('bookings.viewCart', ['cart' => $cart]);
        }
    }

    public function updateCart(Request $request, Cart $cart)
    {

        /* Add extras to the Cart */
        $userId = auth()->user()->id;

        $cart = Cart::where('userId', $userId)
            ->first();

        $cart->featuresTotal = 0;

        if (!empty($request->input('feat1'))) {
            $cart->selectedFeat1 = $cart->feat1;
            $cart->featuresTotal += $request->feat1Price;
        }
        if (!empty($request->input('feat2'))) {
            $cart->selectedFeat2 = $cart->feat2;
            $cart->featuresTotal += $request->feat2Price;
        }
        if (!empty($request->input('feat3'))) {
            $cart->selectedFeat3 = $cart->feat3;
            $cart->featuresTotal += $request->feat3Price;
        }
        if (!empty($request->input('feat4'))) {
            $cart->selectedFeat4 = $cart->feat4;
            $cart->featuresTotal += $request->feat4Price;
        }

        $cart->featuresTotal = $cart->featuresTotal * $cart->numNights;

        $cart->packageTotal = $request->packageTotal * $cart->numNights;
        $cart->selectedPackage = $request->selectedPackage;


        $cart->upgradeTotal = $request->upgradeTotal * $cart->numNights;
        $cart->selectedUpgrade = $request->selectedUpgrade;


        $cart->price = $request->price * $cart->numNights;
        $cart->extrasTotal = $cart->upgradeTotal + $cart->featuresTotal + $cart->packageTotal;


        $cart->finalTotal = $cart->price + $cart->extrasTotal;


        $cart->save();

        return view('bookings.review', ['cart' => $cart]);
    }

    public function review()
    {
        $userId = auth()->user()->id;

        // Find auth user booking details
        $booking = DB::table('bookings')
            ->where('userId', $userId)
            ->get();


        // Find the hotel image 
        $hotelId = Hotel::where('id', $booking->hotel_Id)->first();

        $image = $hotelId->image;

        return view('bookings.review', ['booking' => $booking, 'image', $image]);
    }


    function bookNow()
    {

        $userId = auth()->user()->id;

        $cart = DB::table('cart')
            ->where('user_id', $userId)
            ->first();


        return view('bookings.review', ['cart' => $cart]);
    }

    function placeBooking(Request $req)
    {

        // Get the auth user's cart details
        $userId = auth()->user()->id;
        $fullCart = Cart::where('userId', $userId)
            ->get();

        $req->validate([
            'address' => 'required',
            'payment' => 'required'
        ]);

        // Loop through cart and create new booking
        foreach ($fullCart as $cart) {
            $order = new Booking;
            $order->hotelId = $cart->hotelId;
            $order->userId = $cart->userId;
            $order->name = $req->name;
            $order->status = "Pending";
            $order->address = $req->address;
            $order->payment_method = $req->payment;
            $order->payment_status = "Pending";
            $order->save();
        }

        // Check and redirect based on method of payment
        if ($order->payment_method == 'Online') {
            return redirect('/orders/stripe');
        }

        if ($order->payment_method == 'PayPal') {
            $total = DB::table('cart')
                ->join('hotels', 'cart.hotel_id', '=', 'hotels.id')
                ->where('cart.user_id', $userId)
                ->sum('hotels.price');

            return view('/bookings/paypal', ['total' => $total]);
        } else {
            return redirect('/bookings/stripe');
        }
    }

    function myBookings()
    {

        /* Get auth users id, get booking */
        $userId = auth()->user()->id;

        $bookings = DB::table('bookings')
            ->where('userId', $userId)
            ->get();

        return view('/bookings/myBookings', ['bookings' => $bookings]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::findOrFail($id);
        return view('/bookings/show', ['booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::find($id);

        return view('bookings.edit', compact('booking'))->with('info', 'Please contact the hotel using the form below to amend your booking');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Booking::destroy($id);
        return redirect()->route('myBookings')->with('success', 'Booking successfully deleted');
    }

    public function removeCart($id)
    {
        Cart::destroy($id);

        return redirect()->route('home')->with('success', 'Item successfully removed from cart');
    }
}
