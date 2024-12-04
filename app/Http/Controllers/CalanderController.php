<?php

namespace App\Http\Controllers;

use App\Models\Calander;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalanderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::where('status', 1)->get();
        return view('backend.calander.index', compact('services'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $users = User::where('name', 'LIKE', "%$query%")
            ->select('id', 'name', 'email','country')
            ->get();

        $results = $users->map(function ($user) {
            return [
                'user_id' => $user->id,
                'id' => $user->id,
                'name' => $user->name, // This will be the display name
                'email' => $user->email, // This will be the display name
                'country' => $user->country, // Add the address here
            ];
        });

        return response()->json($results);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function getData()
    {
        return response()->json(Calander::all());
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'customer' => 'required|exists:users,id', // Ensures the user exists
            'service' => 'required|exists:services,id', // Ensures the service exists
            'start_date' => 'required|date', // Validates the start date
            'start_time' => 'required|date_format:H:i', // Validates the start time
            'end_time' => 'required|date_format:H:i|after:start_time', // Ensures end time is after start time
            'description' => 'nullable|string',
        ]);

        // Combine start date and time
        $start = $request->input('start_date') . ' ' . $request->input('start_time');
        $end = $request->input('start_date') . ' ' . $request->input('end_time');

        // Save the data into the `calanders` table
        $user = User::where('id', $request->input('customer'))->first();
        $calander = new Calander();
        $calander->title = $user->name; // Add a meaningful title if needed
        $calander->description = $request->input('description');
        $calander->start = $start;
        $calander->end = $end;
        $calander->user_id = $request->input('customer');
        $calander->service_id = $request->input('service');
        $calander->status = 'pending'; // Default status
        $calander->save();

        // Redirect or return response
        return redirect()->back()->with('success', 'Appointment saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $event = Calander::with('service')->findOrFail($id);
    $user = User::where('id', $event->user_id)->first();
    $startMonth = Carbon::parse($event->start_date)->format('F');
    $eventDate = Carbon::parse($event->start_date)->format('d');
    $eventDateTime = Carbon::parse($event->start_date)->format('D, F j, g:i A'); // Start date and time
    $eventEndTime = Carbon::parse($event->end_date)->format('g:i A'); // End time with AM/PM
    return view('backend.calander.show', compact('event','startMonth','eventDate','eventDateTime','eventEndTime','user'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calander $calander)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calander $calander)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calander $calander)
    {
        //
    }
}
