<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Booking;

class PayPalController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $cart = DB::table('cart')
            ->where('userId', $userId)
            ->first();

        return view('bookings/paypal', [
            'cart' =>  $cart
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function payment(Request $request)
    {
        $userId = auth()->user()->id;

        $cart = Cart::where('userId', $userId)
            ->first();


        if (!$cart) {
            // Handle the case where the cart is not found
            return redirect()->back()->with('error', 'Cart not found');
        }



        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment/cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "GBP",
                        "value" => $cart->finalTotal
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function paymentCancel()
    {
        return redirect()
            ->route('paypal')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            /* If payment successful, create the booking */
            /* Create a new Booking */

            $userId = auth()->user()->id;

            $cart = Cart::where('userId', $userId)
                ->first();
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
            $bookings->payment_method = 'PayPal';
            $bookings->paid = 1;


            $bookings->save();



            Cart::where('userId', $userId)->delete();

            return view('/bookings/myBookings')->with('success', 'Booking completed');
        } else {
            return redirect()
                ->route('bookings.paypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
