<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

//use Illuminate\Support\Facades\Session; //x Session::flash

//use Illuminate\Http\Request;

class ListingController extends Controller
{
    //Visualizza tutti gli annunci
    public function index() {
        return view('listings.index', [
            //'listings' => Listing::all(),
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Visualizza singolo annuncio
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    //Form inserimento
    public function create() {
        return view('listings.create');
    }

    //Salvataggio gigs
    public function store(Request $request) {
        //dd($request->all());
        //dd($request->file('logo'))
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //ctrl se file caricato
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        //dd($formFields);
        Listing::create($formFields);

        //Notifica flash
        //Modo 1
        //Session::flash('message', 'Gig inserito!');

        return redirect('/')->with('message', 'Gig inserito!');
    }

    //Mostra Form Modifica
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    //Salvataggio modifiche
    public function update(Request $request, Listing $listing) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //ctrl se file caricato
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);

        //Notifica flash

        return back()->with('message', 'Gig modificato!');

    }
}