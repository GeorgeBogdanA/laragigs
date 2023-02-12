<?php

use App\Models\Listing;
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
//Tutti
Route::get('/', function () {
    //return view('welcome');
    return view('listings', [
        'heading'  => 'Latest listings',
        'listings' => Listing::all(),
    ]);
});
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
Route::get('/listings/{listing}', function (Listing $listing) {
    return view('listing', [
        'listing' => $listing,
    ]);
});
