<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;

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



/* Footer Routes */
Route::get('/aboutUs', function () {
    return view('aboutUs');
});

Route::get('/contactUs', function () {
    return view('contactUs');
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