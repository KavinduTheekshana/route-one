<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        return view('backend.message.index');
    }

    public function searchUsers(Request $request)
    {
        $query = $request->input('query');

        // Fetch only users where user_type is 'user'
        if ($query) {
            // Filter users based on the search query (name, email, or country) and user_type = 'user'
            $users = User::where('user_type', 'user')
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->orWhere('country', 'like', '%' . $query . '%');
                })
                ->get(['name', 'email', 'country', 'profile_image', 'id']);
        } else {
            // Fetch all users where user_type is 'user' if no query is provided
            $users = User::where('user_type', 'user')
                ->get(['name', 'email', 'country', 'profile_image', 'id']);
        }

        // Return the user data as JSON
        return response()->json(['users' => $users]);
    }

   public function getMessages($userId)
{
    // Retrieve messages where the selected user is the receiver and eager load the sender and receiver details
    $messages = Message::where('receiver_id', $userId)
        ->orWhere('sender_id', $userId) // Include messages where the user is the sender
        ->with([
            'sender:id,name,profile_image',    // Load sender details (name, profile image)
            'receiver:id,name,profile_image'   // Load receiver details (name, profile image)
        ])
        ->orderBy('created_at', 'asc') // Order messages by creation date
        ->get();

    return response()->json($messages); // Return messages with sender and receiver details as JSON
}

    public function sendMessage(Request $request)
    {
        // Validate the input
        $request->validate([
            'message' => 'required|string|max:255',
            'receiver_id' => 'required|integer',
        ]);

        // Save the message
        $message = new Message();
        $message->sender_id = auth()->user()->id; // Assuming the sender is the logged-in user
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        // Return a JSON response for AJAX
        return response()->json(['success' => true]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
