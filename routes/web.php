<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

//Nomenclatore funzioni
//index - Tutti
//show - Uno
//create - Form inserimento
//store - Salvataggio
//edit - Form modifica
//update - Aggiornamento
//destroy - Cancellazione

//Tutti
Route::get('/', [ListingController::class, 'index']);


//Form inserimento listing solo per utenti registrati
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//Salvataggio listing
Route::post('/listings', [ListingController::class, 'store']);

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Singolo old
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);
//     if ($listing) {
//         return view('listing', [
//             'listing' => $listing,
//         ]);
//     } else {abort('404');}
// });

//Singolo Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Utenti
//Registra
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Store user
Route::post('/users', [UserController::class, 'store']);

//Login Form. Gli do un nome che serve al middleware authenticate
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Login 
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');