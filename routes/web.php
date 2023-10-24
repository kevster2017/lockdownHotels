<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Hotel routes */
Route::get("/hotels", [HotelController::class, 'index']);
Route::get("/hotels/create", [HotelController::class, 'create'])->name('hotels.create');
Route::post("/hotels", [HotelController::class, 'store'])->name('hotels.store');

Route::get("/hotels/{id}/edit", [HotelController::class, 'edit'])->name('hotels.edit');
Route::put("/hotels/{id}", [HotelController::class, 'update'])->name('hotels.update');
Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy')->middleware('auth');

Route::get("/hotels/show/{id}", [HotelController::class, 'show'])->name('hotels.show');

/* Booking routes */
Route::get("/bookings", [BookingController::class, 'index']);
Route::get("/bookings/create", [BookingController::class, 'create'])->name('bookings.create');
Route::post("/bookings", [BookingController::class, 'store'])->name('bookings.store');

Route::get("/bookings/{id}/edit", [BookingController::class, 'edit'])->name('bookings.edit');
Route::put("/bookings/{id}", [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy')->middleware('auth');

Route::get("/bookings/show/{id}", [BookingController::class, 'show'])->name('bookings.show');

Route::get("/bookings/review", [BookingController::class, 'review'])->name('bookings.review');
Route::get("/bookings/payment", [BookingController::class, 'payment'])->name('bookings.payment');
Route::get("/bookings/addonPayment", [BookingController::class, 'addonPayment'])->name('bookings.addonPayment');
Route::get("/bookings/paymentComplete", [BookingController::class, 'paymentComplete'])->name('bookings.paymentComplete');


/* Footer Routes */
Route::get('/aboutUs', function () {
    return view('aboutUs');
});

Route::get('/contactUs', function () {
    return view('contactUs');
});

Route::get('/contactUsComplete', function () {
    return view('contactUsComplete');
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
