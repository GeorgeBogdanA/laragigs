<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

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