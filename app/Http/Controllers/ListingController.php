<?php

namespace App\Http\Controllers;

use App\Models\Listing;

//use Illuminate\Http\Request;

class ListingController extends Controller
{
    //Visualizza tutti gli annunci
    public function index() {
        return view('listings.index', [
            //'listings' => Listing::all(),
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }
    //Visualizza singolo annuncio
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }
}