<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cart;

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

        $user_id = auth()->user()->id;
        $total = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $user_id)
            ->sum('products.price');


        return view('orders.orderNow', ['total' => $total]);
    }

    function placeBooking(Request $req)
    {
        $user_id = auth()->user()->id;
        $fullCart = Cart::where('user_id', $user_id)
            ->get();

        $req->validate([
            'address' => 'required',
            'payment' => 'required'
        ]);

        foreach ($fullCart as $cart) {
            $order = new Order;
            $order->product_id = $cart->product_id;
            $order->user_id = $cart->user_id;
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
                ->join('products', 'cart.product_id', '=', 'products.id')
                ->where('cart.user_id', $user_id)
                ->sum('products.price');

            return view('/orders/paypal', ['total' => $total]);
        } else {
            return redirect('/orders/stripe');
        }
    }

    function myBookings()
    {

        $user_id = auth()->user()->id;

        $ids = DB::table('orders')
            ->where('user_id', $user_id)
            ->get();

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $user_id)
            ->select('*', 'orders.id as order_id') // Selects the original order ID
            ->paginate(5);

        return view('orders.myOrders', ['orders' => $orders, 'ids' => $ids]);
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
