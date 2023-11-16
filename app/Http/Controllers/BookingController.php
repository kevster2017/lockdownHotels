<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bookings.create');
    }

    public function review()
    {
        return view('bookings.review');
    }

    public function payment()
    {
        return view('bookings.payment');
    }

    public function addonPayment()
    {
        return view('bookings.addonPayment');
    }

    public function paymentComplete()
    {
        return view('bookings.paymentComplete');
    }

    /**
     * Book Hotel by adding to Cart
     */

    function addToCart(Request $request)
    {


        $cart = new Cart;
        $cart->userId = auth()->user()->id;
        $cart->hotel_Id = $request->hotel_Id;
        $cart->price =  $request->price;
        $cart->checkInDate =  $request->checkInDate;
        $cart->name =  $request->name;
        $cart->image = $request->image;
        $cart->address = $request->address;
        $cart->town = $request->town;
        $cart->country = $request->country;
        $cart->postCode = $request->postCode;
        $cart->accomType = $request->accomType;
        $cart->roomType = $request->roomType;
        $cart->holidayType = $request->holidayType;
        if ($request->feat1 == "") {
            $cart->feat1 = 0;
        } else {
            $cart->feat1 = $request->feat1;
        }
        if ($request->feat2 == "") {
            $cart->feat2 = 0;
        } else {

            $cart->feat2 = $request->feat2;
        }
        if ($request->feat3 == "") {
            $cart->feat3 = 0;
        } else {

            $cart->feat3 = $request->feat3;
        }
        if ($request->feat4 == "") {
            $cart->feat4 = 0;
        } else {

            $cart->feat4 = $request->feat4;
        }

        $cart->feat1Price = $request->feat1Price;
        $cart->feat2Price = $request->feat2Price;
        $cart->feat3Price = $request->feat3Price;
        $cart->feat4Price = $request->feat4Price;

        if ($request->upgrade1 == "") {
            $cart->upgrade1 = 0;
        } else {
            $cart->upgrade1 = $request->upgrade1;
        }
        if ($request->upgrade2 == "") {
            $cart->upgrade2 = 0;
        } else {
            $cart->upgrade2 = $request->upgrade2;
        }
        if ($request->upgrade3 == "") {
            $cart->upgrade3 = 0;
        } else {
            $cart->upgrade3 = $request->upgrade3;
        }


        $cart->upgrade1Price = $request->upgrade1Price;
        $cart->upgrade2Price = $request->upgrade2Price;
        $cart->upgrade3Price = $request->upgrade3Price;
        if ($request->package1 == "") {
            $cart->package1 = 0;
        } else {
            $cart->package1 = $request->package1;
        }
        if ($request->package2 == "") {
            $cart->package2 = 0;
        } else {
            $cart->package2 = $request->package2;
        }
        if ($request->package3 == "") {
            $cart->package3 = 0;
        } else {
            $cart->package3 = $request->package3;
        }

        $cart->package1Price = $request->package1Price;
        $cart->package2Price = $request->package2Price;
        $cart->package3Price = $request->package3Price;
        $cart->currency = $request->currency;
        $cart->numNights = $request->numNights;
        $hotelPrice = $cart->price;
        $featPrice = ($cart->feat1 + $cart->feat2 + $cart->feat3 + $cart->feat4);
        $upgradePrice = ($cart->upgrade1 + $cart->upgrade2 + $cart->upgrade3);
        $packagePrice = ($cart->package1 + $cart->package2 + $cart->package3);
        $price = ($hotelPrice + $featPrice + $upgradePrice + $packagePrice) * $cart->numNights;
        $cart->price = $price;
        //dd($featPrice);


        $cart->save();

        return redirect('/bookings/cartList')->with('success', 'Booking updated');
    }

    static function cartItem()
    {

        $userId = optional(Auth::user())->id;

        return Cart::where('userId', $userId)->count();
    }

    function cartList()
    {

        $userId = auth()->user()->id;

        $bookings = DB::table('cart')
            ->join('hotels', 'cart.hotel_Id', '=', 'hotels.id')
            ->where('cart.userId', $userId)
            ->select('hotels.*', 'cart.id as cart_id')
            ->get();

        return view('bookings.cartList', ['bookings' => $bookings]);
    }

    function removeCart($id)
    {
        Cart::destroy($id);

        return redirect()->back()->with('success', 'Item successfully removed from bookings');
    }

    function bookNow()
    {

        $userId = auth()->user()->id;
        $total = DB::table('cart')
            ->join('hotels', 'cart.hotel_id', '=', 'hotels.id')
            ->where('cart.userId', $userId)
            ->sum('hotels.price');


        return view('bookings.review', ['total' => $total]);
    }

    function placeBooking(Request $req)
    {
        $userId = auth()->user()->id;
        $fullCart = Cart::where('userId', $userId)
            ->get();

        $req->validate([
            'address' => 'required',
            'payment' => 'required'
        ]);

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
            // Cart::where('user_id', $user_id)->delete();

        }

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

        $userId = auth()->user()->id;

        $ids = DB::table('bookings')
            ->where('userId', $userId)
            ->get();

        $bookings = DB::table('bookings')
            ->join('hotels', 'bookings.hotel_id', '=', 'hotels.id')
            ->where('bookings.userId', $userId)
            ->select('*', 'bookings.id as booking_id') // Selects the original order ID
            ->paginate(5);

        return view('bookings.myBookings', ['bookings' => $bookings, 'ids' => $ids]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
