<?php

namespace App\Http\Controllers;

use App\Mail\NewMessageNotification;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use NotifyLk\Api\SmsApi;

class MessageController extends Controller
{
    public function markAsRead($sender_id)
    {
        // Mark all messages from the sender as read
        Message::where('sender_id', $sender_id)->update(['status' => true]);

        return response()->json(['success' => true]);
    }


    public function index()
    {
        return view('backend.message.index');
    }

    public function searchUsers(Request $request)
    {
        $query = $request->input('query');
        $authUser = auth()->user();
        // Fetch only users where user_type is 'user'
        if ($authUser->user_type === 'superadmin') {
            if ($query) {
                // Filter users based on the search query (name, email, or country) and user_type = 'user'
                // $users = User::where('user_type', 'user')
                //     ->where(function ($queryBuilder) use ($query) {
                //         $queryBuilder->where('name', 'like', '%' . $query . '%')
                //             ->orWhere('email', 'like', '%' . $query . '%')
                //             ->orWhere('country', 'like', '%' . $query . '%');
                //     })
                //     ->get(['name', 'email', 'country', 'profile_image', 'id']);
                $users = User::where('user_type', 'user')
                    ->whereIn('id', function ($query) {
                        $query->select('sender_id')->from('messages');
                    })
                    ->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('name', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%')
                            ->orWhere('country', 'like', '%' . $query . '%');
                    })
                    ->orderByDesc(
                        Message::select('created_at')
                            ->whereColumn('messages.sender_id', 'users.id')
                            ->latest()
                            ->take(1)
                    )
                    ->get(['name', 'email', 'country', 'profile_image', 'id']);
            } else {
                $users = User::where('user_type', 'user')
                    ->whereIn('id', function ($query) {
                        $query->select('user_id')->fromSub(function ($subQuery) {
                            $subQuery->select('sender_id as user_id')->from('messages')
                                ->union(
                                    Message::select('receiver_id')->from('messages')
                                );
                        }, 'all_users');
                    })
                    ->orderByDesc(
                        Message::whereColumn('messages.sender_id', 'users.id')
                            ->orWhereColumn('messages.receiver_id', 'users.id')
                            ->select('created_at')
                            ->latest()
                            ->take(1)
                    )
                    ->get(['name', 'email', 'country', 'profile_image', 'id']);
            }
        } elseif ($authUser->user_type === 'agent') {
            if ($query) {
                // Filter users based on the search query (name, email, or country) and user_type = 'user'
                $users = User::where('user_type', 'user')
                    ->where('agent_id', Auth::id())
                    ->where(function ($queryBuilder) use ($query) {
                        $queryBuilder->where('name', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%')
                            ->orWhere('country', 'like', '%' . $query . '%');
                    })
                    ->get(['name', 'email', 'country', 'profile_image', 'id']);
            } else {
                // Fetch all users where user_type is 'user' if no query is provided
                $users = User::where('user_type', 'user')
                    ->where('agent_id', Auth::id())
                    ->get(['name', 'email', 'country', 'profile_image', 'id']);
            }
        } else {
            abort(403, 'Unauthorized access');
        }

        // Return the user data as JSON
        return response()->json(['users' => $users]);
    }

    public function getUser($userId)
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

    public function getMessages($userId)
    {

        $authUser = auth()->user();

        if ($authUser->user_type === 'superadmin') {
            // Retrieve all messages for the selected userId
            $messages = Message::where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
                ->with([
                    'sender:id,name,profile_image',    // Load sender details (name, profile image)
                    'receiver:id,name,profile_image'  // Load receiver details (name, profile image)
                ])
                ->orderBy('created_at', 'asc') // Order messages by creation date
                ->get();
        } else {
            // Get the authenticated user's ID
            $authUserId = Auth::id();

            // Retrieve messages where the authenticated user is either the sender or receiver
            $messages = Message::where(function ($query) use ($authUserId, $userId) {
                $query->where('sender_id', $authUserId)
                    ->where('receiver_id', $userId);
            })
                ->orWhere(function ($query) use ($authUserId, $userId) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id', $authUserId);
                })
                ->with([
                    'sender:id,name,profile_image',    // Load sender details (name, profile image)
                    'receiver:id,name,profile_image'   // Load receiver details (name, profile image)
                ])
                ->orderBy('created_at', 'asc') // Order messages by creation date (ascending or descending based on preference)
                ->get();
        }
        return response()->json($messages); // Return messages with sender and receiver details as JSON
    }

    public function sendMessage(Request $request)
    {
        // Validate the input
        $request->validate([
            'message' => 'required|string|max:65535',
            'receiver_id' => 'required|integer',
            'attachments.*' => 'file|max:2048', // 2MB per file
        ]);

        // Initialize attachments array
        $attachments = [];

        // Check if there are any files uploaded
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // Store the file in the 'public/attachments' directory and get the file path
                $path = $file->store('attachments', 'public');

                // Get the original file name
                $originalFileName = $file->getClientOriginalName();

                // Save both the file path and the original file name in the array
                $attachments[] = [
                    'path' => $path,
                    'original_name' => $originalFileName
                ];
            }
        }

        // Save the message
        $message = new Message();
        $message->sender_id = auth()->user()->id; // Assuming the sender is the logged-in user
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->attachments = count($attachments) > 0 ? json_encode($attachments) : null;
        $message->save();

        // Get the receiver's email
        $receiver = User::find($request->receiver_id);
        $messagecontent = $request->message;
        $phone = $receiver->phone;

        if (str_starts_with($phone, '0') && strlen($phone) === 10) {
            $phone = '94' . substr($phone, 1);
            // Send SMS notification to the receiver
            $this->sendTextMessage($phone, $receiver->name);
        } elseif (str_starts_with($phone, '+94') && strlen($phone) === 12) {
            $phone = substr($phone, 1);
            $this->sendTextMessage($phone, $receiver->name);
        }
        // Send email notification to the receiver
        if ($receiver) {
            // Simulate a long message
            Mail::to($receiver->email)->send(new NewMessageNotification($messagecontent, auth()->user()));
        } else {
            Log::error('User not found with ID: ' . $request->receiver_id);
        }

        // Return a JSON response for AJAX
        return response()->json(['success' => true]);
    }

    private function sendTextMessage($phone, $name,)
    {
        $api_instance = new SmsApi();
        $user_id = "25086";
        $api_key = "bxw9mVd8JJRz2nVFR1bR";
        $message = "Dear " . $name . ", \n\nYou have received a new message from Route One Recruitment. Please check your email. \n\nBest Regards,\nRoute One Recruitment";
        // $message = $messagecontent;
        // $message = "Your Verification Code is: " . $storedOtp . "\n\nThanks for voting with us!\nIf you didn't request an OTP, click here.\nhttps://bit.ly/3Z3gBZ2";
        $to = $phone;
        $sender_id = "ROUTE ONE";
        try {
            $api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id);
            // return redirect()->route('vote')->with('status', 'SMS sent successfully');
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage(), ['exception' => $e]);
            echo ($e->getMessage());
            return redirect()->route('vote')->with('exception', 'Something went wrong');
        }
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
