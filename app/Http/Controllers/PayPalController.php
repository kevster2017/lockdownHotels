<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

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
                        "currency_code" => "USD",
                        "value" => "100.00"
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
            return redirect()
                ->route('home')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('paypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
