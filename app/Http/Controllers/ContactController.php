<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        // Return the view with the contact form
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        // Validate the input
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Save the contact message to the database
        Contact::create($data);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
