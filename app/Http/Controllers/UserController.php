<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show register form
    public function create() {
        return view('users.register');
    }

    //Store user
    public function store(Request $request) {
        //dd($request->all());
        //dd($request->file('logo'))
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and loged in');
    }

    //Login form
    public function login() {
        return view('users.login');
    }

    //Authenticate user
    public function authenticate(Request $request) {
        //dd($request->all());
        //dd($request->file('logo'))
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now login');
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');

    }

    //Logout
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout');

    }
}