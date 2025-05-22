<?php

use App\Http\Controllers\FlightMasterController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('home');
});
Route::resource('/passenger', PassengerController::class);
Route::resource('/flightmaster', FlightMasterController::class);
Route::resource('/booking', BookingController::class);
Route::get('/flightmaster/create', action: [FlightMasterController::class, 'create'])->name('flightmaster.create');
Route::patch('/booking/{id}', action: [BookingController::class, 'update'])->name('booking.update');
