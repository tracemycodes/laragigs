<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

// All Listings
Route::get('/', [ListingController::class, 'index']);

//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Single Listings
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listings}/edit', [ListingController::class, 'edit'])->middleware('auth');


// update Listing
Route::put('/listings/{listings}', [ListingController::class, 'update'])->middleware('auth');

// delete Listing
Route::delete('/listings/{listings}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');
 




// Single Listings
Route::get('/listings/{listings}', [ListingController::class, 'show']);

// Show register create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// create new users
Route::post('/users', [UserController::class, 'store']);

// Log users out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
