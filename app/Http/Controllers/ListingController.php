<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class listingController extends Controller {
    
    // Show All Listing
    public function index() {
        // Make sure that the value of request stored in an array.  
        return view('listings.index', [
            'listings' => Listing::latest()->filter
            (request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show Single Listing
    public function show(Listing $listing) {
        // In our route we used Laravel's route model binding feature so we don't need to explicitly call find()    .
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request) {

        // Don't forget to add logo attribute to the migration!.
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

       
        if($request->hasFile('logo')) {
            // Logos as create for me in a folder called logos in storage.
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Adding user_id to formFields
        $formFields['user_id'] = auth()->id();
            
        // BuiltIn function in Eloquent
        listing::create($formFields);
       
        // Redirect to homepage
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listing) { 
        return view('listings.edit', ['listing' => $listing]);
    }
    // Updating Listing Data
    // We need to pass the $listing since we need to update an existing listing
    public function update(Request $request, Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort('403', 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        // We don't use the Listing model since we are updating an existing listing, instead we use the $listing and update it.
        $listing->update($formFields);
        
        // Redirect to the same page.
        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete listing
    public function destroy(Listing $listing) {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort('403', 'Unauthorized Action');
        }
        // Delete the logo if exist
        if($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // Manage Listings 
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
