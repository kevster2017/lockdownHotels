<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PayPalController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


/* Hotel routes */
Route::get("/hotels", [HotelController::class, 'index'])->name('hotels.index');
Route::get("/hotels/create", [HotelController::class, 'create'])->name('hotels.create')->middleware('auth');
Route::post("/hotels", [HotelController::class, 'store'])->name('hotels.store');

Route::get("/hotels/{id}/edit", [HotelController::class, 'edit'])->name('hotels.edit');
Route::put("/hotels/{id}", [HotelController::class, 'update'])->name('hotels.update');
Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy')->middleware('auth');

Route::get("/hotels/show/{id}", [HotelController::class, 'show'])->name('hotels.show');


Route::get('/hotels/city', [HotelController::class, 'cityIndex'])->name('hotels.city');
Route::get('/hotels/seaside', [HotelController::class, 'seasideIndex'])->name('hotels.seaside');
Route::get('/hotels/country', [HotelController::class, 'countryIndex'])->name('hotels.country');

Route::get('/hotels/myHotels', [HotelController::class, 'myHotels'])->name('myHotels')->middleware('auth');
Route::get('/hotels/myHotelsShow/{id}', [HotelController::class, 'myHotelsShow'])->name('hotels.myHotelsShow');


/* Booking routes */
Route::get("/bookings", [BookingController::class, 'index']);
Route::get("/bookings/create", [BookingController::class, 'create'])->name('bookings.create');
Route::get("/bookings/myBookings", [BookingController::class, 'myBookings'])->name('myBookings')->middleware('auth');

Route::post("/bookings/store", [BookingController::class, 'store'])->name('bookings.store');

Route::get("/bookings/{id}/edit", [BookingController::class, 'edit'])->name('bookings.edit');
Route::put("/bookings/{id}", [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy')->middleware('auth');

Route::get("/bookings/show/{id}", [BookingController::class, 'show'])->name('bookings.show');

Route::get("/bookings/review", [BookingController::class, 'review'])->name('bookings.review');
Route::get("/bookings/payment", [BookingController::class, 'payment'])->name('bookings.payment');
Route::get("/bookings/addonPayment", [BookingController::class, 'addonPayment'])->name('bookings.addonPayment');
Route::get("/bookings/paymentComplete", [BookingController::class, 'paymentComplete'])->name('bookings.paymentComplete');

/* Cart routes */
Route::post("/add_to_cart", [BookingController::class, 'addToCart'])->name('addToCart')->middleware('auth');
Route::get("/bookings/viewCart", [BookingController::class, 'viewCart'])->middleware('auth')->name("viewCart");
Route::put("/update_cart/{id}", [BookingController::class, 'updateCart'])->name('cart.update');
Route::delete("/removeCart/{id}", [BookingController::class, 'removeCart'])->name('delete.cart');


/* PayPal routes */

Route::get('bookings/paypal', [PayPalController::class, 'index'])->name('bookings.paypal');
Route::post('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');

/* Stripe Payment routes */
Route::get('/bookings/stripe', [StripeController::class, 'stripe'])->name('bookings.stripe');
Route::post('/bookings/stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

/* Contact Routes */

Route::get('/contactUs', function () {
    return view('contactUs');
});

Route::get("/contact", [ContactController::class, 'index'])->name('contact.index')->middleware('auth');
Route::get("/contact/create", [ContactController::class, 'create'])->name('contact.create')->middleware('auth');
Route::post("/contact/store", [ContactController::class, 'store'])->name('contact.store')->middleware('auth');

Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy')->middleware('auth');
Route::get("/contact/show/{id}", [ContactController::class, 'show'])->name('contact.show');

Route::get('/contact/contactComplete', function () {
    return view('contactComplete');
})->name('contactComplete');



/* Footer Routes */
Route::get('/aboutUs', function () {
    return view('aboutUs');
});

Route::get('/siteMap', function () {
    return view('siteMap');
});

Route::get('/tsAndCs', function () {
    return view('tsAndCs');
});

Route::get('/privacyPolicy', function () {
    return view('privacypolicy');
});
