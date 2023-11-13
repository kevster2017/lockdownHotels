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
        $cart->save();
        return redirect('/bookings.cartList')->with('success', 'Booking updated');
    }

    static function cartItem()
    {

        $userId = optional(Auth::user())->id;

        return Cart::where('userId', $userId)->count();
    }

    function cartList()
    {

        $userId = auth()->user()->id;

        $hotels = DB::table('cart')
            ->join('hotels', 'cart.hotel_Id', '=', 'hotels.id')
            ->where('cart.userId', $userId)
            ->select('hotels.*', 'cart.id as cart_id')
            ->get();

        return view('bookings.cartList', ['hotels' => $hotels]);
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
