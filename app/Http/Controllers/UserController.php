<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller {
    // Show Register/Create Form
    public function create(Request $request) {
        return view('users/register');
    }

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        auth()->Login($user);

        return redirect('/')->with('message','User created and logged in successfully');
    }

    // Logout User
    public function logout(Request $request) {
        // This will remove authentication information from the user session.
        auth()->logout();

        // Its recommended to invalidate user session and regenerate their csrf token.
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Show Login Form
    public function login(Request $request) {
        return view('users.login');
    }

    // authenticate User
    public function authenticate(Request $request) {

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Now we need to attempt to log user in
        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message','You are now logged in!');
        }
        
        // This way we are showing error without saying what and where is the error for safety purposes.
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}