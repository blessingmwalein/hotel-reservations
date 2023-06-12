<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomFeedBackController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RoomController::class, 'welcome'])->name('home');
Route::get('/dashboard', [RoomController::class, 'welcome'])->name('home');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('room.show');
Route::get('/rooms/{room}/book', [RoomController::class, 'book'])->name('room.book');
Route::post('/room-feedback', [RoomFeedBackController::class, 'store'])->name('feedback.store');
Route::post('/reservations/store', [ReservationController::class, 'storeClient'])->name('client.reservations.store');


//admin routes
Route::middleware([
    'auth:sanctum',
])->group(function () {
    //prefix admin

    Route::prefix('admin')->group(function () {
        //dashboard
        Route::get('/dashboard', [UserController::class, 'adminDash'])->name('admin.dashboard');


        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::put('/users/{user}/update', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('admin.users.delete');



        Route::get('/room-types', [RoomTypeController::class, 'index'])->name('admin.room-types');
        Route::post('/room-types/store', [RoomTypeController::class, 'store'])->name('admin.room-types.store');
        Route::put('/room-types/{roomType}/update', [RoomTypeController::class, 'update'])->name('admin.room-types.update');
        Route::delete('/room-types/{roomType}/delete', [RoomTypeController::class, 'destroy'])->name('admin.room-types.delete');



        Route::get('/rooms', [RoomController::class, 'index'])->name('admin.rooms');
        Route::post('/rooms/store', [RoomController::class, 'store'])->name('admin.rooms.store');
        Route::put('/rooms/{room}/update', [RoomController::class, 'update'])->name('admin.rooms.update');
        Route::delete('/rooms/{room}/delete', [RoomController::class, 'destroy'])->name('admin.rooms.delete');



        Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations');
        Route::post('/reservations/store', [ReservationController::class, 'store'])->name('admin.reservations.store');
        Route::put('/reservations/{reservation}/update', [ReservationController::class, 'update'])->name('admin.reservations.update');
        Route::delete('/reservations/{reservation}/delete', [ReservationController::class, 'destroy'])->name('admin.reservations.delete');
        Route::post('/reservations/{reservation}/approve', [ReservationController::class, 'approve'])->name('admin.reservations.approve');
        Route::post('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('admin.reservations.cancel');



        Route::get('/amenities', [AmenityController::class, 'index'])->name('admin.amenities');
        Route::post('/amenities/store', [AmenityController::class, 'store'])->name('admin.amenities.store');
        Route::put('/amenities/{amenity}/update', [AmenityController::class, 'update'])->name('admin.amenities.update');
        Route::delete('/amenities/{amenity}/delete', [AmenityController::class, 'destroy'])->name('admin.amenities.delete');


        Route::get('/transactions', [TransactionController::class, 'index'])->name('admin.transactions');
    });

    Route::prefix('user')->group(function () {
        //dashboard
        Route::get('/reservations', [ReservationController::class, 'userReservations'])->name('user.reservations');
        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::post('/profile', [UserController::class, 'profileUpdate'])->name('user.profile.update');
        Route::post('/profile/password', [UserController::class, 'passwordUpdate'])->name('user.password.update');
    });
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
