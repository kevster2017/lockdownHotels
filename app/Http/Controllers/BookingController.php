<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cart;
use App\Models\Hotel;
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

        // dd($bookings);


        return view('bookings.cartList', ['bookings' => $bookings]);
    }

    function removeCart($id)
    {
        Cart::destroy($id);

        return redirect()->back()->with('success', 'Item successfully removed from bookings');
    }

    public function review()
    {
        $userId = auth()->user()->id;


        $booking = DB::table('bookings')
            ->where('userId', $userId)
            ->get();

        //dd($booking);
        $hotelId = Hotel::where('id', $booking->hotel_Id)->first();

        dd($hotelId);
        $image = $hotelId->image;

        return view('bookings.review', ['booking' => $booking, 'image', $image]);
    }


    function bookNow()
    {

        $userId = auth()->user()->id;

        /*
        $total = DB::table('cart')
            ->join('hotels', 'cart.hotel_id', '=', 'hotels.id')
            ->where('cart.userId', $userId)
            ->sum('hotels.price');
*/
        $cart = DB::table('cart')
            ->where('user_id', $userId)
            ->first();


        return view('bookings.review', ['cart' => $cart]);
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
    public function store(Request $request, Booking $booking)
    {


        $booking->userId = auth()->user()->id;
        $booking->hotel_Id = $request->hotel_Id;
        $booking->hotelName = $request->hotelName;
        $booking->pricePN =  $request->price;
        $booking->checkInDate =  $request->checkInDate;
        $booking->name =  $request->name;
        $booking->email =  $request->email;
        $booking->image = $request->image;
        $booking->address = $request->address;
        $booking->town = $request->town;
        $booking->country = $request->country;
        $booking->postCode = $request->postCode;
        $booking->accomType = $request->accomType;
        $booking->roomType = $request->roomType;
        $booking->holidayType = $request->holidayType;
        if ($request->feat1 == "") {
            $booking->feat1 = 0;
        } else {
            $booking->feat1 = $request->feat1;
        }
        if ($request->feat2 == "") {
            $booking->feat2 = 0;
        } else {

            $booking->feat2 = $request->feat2;
        }
        if ($request->feat3 == "") {
            $booking->feat3 = 0;
        } else {

            $booking->feat3 = $request->feat3;
        }
        if ($request->feat4 == "") {
            $booking->feat4 = 0;
        } else {

            $booking->feat4 = $request->feat4;
        }

        $booking->feat1Price = $request->feat1Price;
        $booking->feat2Price = $request->feat2Price;
        $booking->feat3Price = $request->feat3Price;
        $booking->feat4Price = $request->feat4Price;
        $booking->featuresTotal = $booking->feat1 + $booking->feat2 + $booking->feat3 + $booking->feat4;

        if ($request->upgrade1 == "") {
            $booking->upgrade1 = 0;
        } else {
            $booking->upgrade1 = $request->upgrade1;
        }
        if ($request->upgrade2 == "") {
            $booking->upgrade2 = 0;
        } else {
            $booking->upgrade2 = $request->upgrade2;
        }
        if ($request->upgrade3 == "") {
            $booking->upgrade3 = 0;
        } else {
            $booking->upgrade3 = $request->upgrade3;
        }

        $booking->upgrade1Price = $request->upgrade1Price;
        $booking->upgrade2Price = $request->upgrade2Price;
        $booking->upgrade3Price = $request->upgrade3Price;


        $booking->upgradeTotal = $booking->upgrade1 + $booking->upgrade2 + $booking->upgrade3;
        $booking->extrasTotal = $booking->featuresTotal + $booking->packageTotal + $booking->upgradeTotal;

        if ($request->package1 == "") {
            $booking->package1 = 0;
        } else {
            $booking->package1 = $request->package1;
        }
        if ($request->package2 == "") {
            $booking->package2 = 0;
        } else {
            $booking->package2 = $request->package2;
        }
        if ($request->package3 == "") {
            $booking->package3 = 0;
        } else {
            $booking->package3 = $request->package3;
        }

        $booking->package1Price = $request->package1Price;
        $booking->package2Price = $request->package2Price;
        $booking->package3Price = $request->package3Price;
        $booking->packageTotal = $booking->package1 + $booking->package2 + $booking->package3;
        $booking->currency = $request->currency;
        $booking->numNights = $request->numNights;
        $hotelPrice = $booking->price;
        $featuresPrice = ($booking->feat1 + $booking->feat2 + $booking->feat3 + $booking->feat4);
        $upgradePrice = ($booking->upgrade1 + $booking->upgrade2 + $booking->upgrade3);
        $packagePrice = ($booking->package1 + $booking->package2 + $booking->package3);
        $total = ($hotelPrice + $featuresPrice + $upgradePrice + $packagePrice) * $booking->numNights;
        $booking->payment_method = $request->payment_method;
        $booking->total = $total;
        //dd($featPrice);

        // dd($booking);
        $booking->save();

        $payment = Booking::where('id', $booking->id)->first();
        // dd($payment);

        return view('bookings/stripe', [
            'payment' => $payment
        ])->with('success', 'Booking updated');
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
