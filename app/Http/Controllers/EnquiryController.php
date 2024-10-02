<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function contact()
    {
        $contacts = Enquiry::orderBy('created_at', 'desc')
            ->get();

        return view('backend.contact.index', compact('contacts'));
    }

    public function unread(Enquiry $enquiry)
    {
        $enquiry->status = 0;
        $enquiry->save();
        return redirect()->back()->with('success', 'Enquiry has been mark as unread successfully.');
    }

    public function read(Enquiry $enquiry)
    {
        $enquiry->status = 1;
        $enquiry->save();
        return redirect()->back()->with('success', 'Enquiry has been mark as read successfully.');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:15',
            'subject'    => 'required|string|max:255',
            'country'    => 'required|string|max:255',
            'message'    => 'required|string',
        ]);

        // Save data into the database
        Enquiry::create($request->all());

        // Return a JSON response for success
        return response()->json(['success' => 'Your message has been submitted successfully!']);
    }


    public function show($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        return response()->json($enquiry);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enquiry $enquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect()->back()->with('success', 'Enquiry deleted successfully!');
    }
}
