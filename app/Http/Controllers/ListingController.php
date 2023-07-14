<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request('tag', 'search'))->paginate(6)
        ]);
    }

    // Show single listings
    public function show(Listing $listings)
    {
        return view('listings.show', [
            'listings' => $listings
        ]);
    }

    //Show Create Form
    public function create()
    {
        return view('listings.create');
    }

    //Store Listing data
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form
    public function edit(Listing $listings)
    {
        return view('listings.edit', ['listings' => $listings]);
    }

    // Update listing Data
    public function update(Request $request, Listing $listings)
    {
        // Make sure logged in user edits only
        if ($listings->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }


        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listings->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    //Delete Listing
    public function destroy(Listing $listings)
    {

        // Make sure logged in user deletes only
        if ($listings->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listings->delete();
        return redirect(('/'))->with('message', 'Listing deleted successfully');
    }

    // Manage Listings
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
