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

//Form inserimento gigs
Route::get('/listings/create', [ListingController::class, 'create']);

//Salvataggio gigs
Route::post('/listings', [ListingController::class, 'store']);

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

//Singolo old
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);
//     if ($listing) {
//         return view('listing', [
//             'listing' => $listing,
//         ]);
//     } else {abort('404');}
// });

//Singolo new
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Utenti
//Registra
Route::get('/register', [UserController::class, 'create']);

//Store user
Route::post('/users', [UserController::class, 'store']);

//Login Form
Route::get('/login', [UserController::class, 'login']);

//Login 
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

//Logout
Route::post('/logout', [UserController::class, 'logout']);