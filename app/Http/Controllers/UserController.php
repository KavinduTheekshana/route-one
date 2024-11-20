<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserNotes;
use App\Models\Vacancies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'review' => 'required|string',
        ]);

        // Update if the note exists, otherwise create a new one
        UserNotes::updateOrCreate(
            ['user_id' => $request->user_id], // Check by user_id
            ['review' => $request->review]   // Update the review
        );

        return redirect()->back()->with('success', 'Notes saved successfully!');
    }


    public function users()
    {
        $authUser = auth()->user();

        // Initialize the $users query
        if ($authUser->user_type === 'superadmin') {
            $users = User::where('user_type', '=', 'user')
                ->orderBy('id', 'desc')
                ->get();
        } elseif ($authUser->user_type === 'agent') {
            $agentId = Auth::id(); // Get authenticated user's ID

            // Fetch applications where the agent matches and include user data
            $users = Application::where('agent', $agentId)
                ->with('user') // Eager load user relationship
                ->get();
        } else {
            abort(403, 'Unauthorized access');
        }



        return view('backend.user.manage.manage', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create.index');
    }

    public function details(Request $request)
    {

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Set default profile image if not provided


        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'user_type' => 'user',  // Assuming 'role' field corresponds to 'user_type'
            'country' => $validatedData['country'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Member created successfully!');
    }

    public function user_destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function user_block(User $user)
    {
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('success', 'User has been disabled successfully.');
    }

    public function user_unblock(User $user)
    {
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('success', 'User has been activate successfully.');
    }

    public function user_settings($id)
    {
        $user = User::findOrFail($id);
        $documents = Document::where('user_id', $id)->get();
        $application = Application::where('user_id', $id)->first();
        $agents = User::where('user_type', 'agent')->get();

        $note = UserNotes::where('user_id', $id)->first();

        // Fetch the jobs that the user has applied for
        $vacancies = JobApplication::where('user_id', $user->id)
            ->with('job') // Assuming you have a relationship defined
            ->get();

        $jobs = Vacancies::get();
        return view('backend.user.settings.settings', compact('user', 'documents', 'application', 'agents', 'vacancies', 'jobs','note'));
    }

    public function user_update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Store the new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Save the updated user data
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User Profile updated successfully.');
    }

    // Team Functions

    public function team()
    {
        $users = User::where('user_type', '!=', 'user')->get();
        return view('backend.team.manage', compact('users'));
    }

    public function settings($id)
    {
        $user = User::findOrFail($id);
        return view('backend.team.settings', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'role' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->user_type = $request->input('role');

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Store the new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Save the updated user data
        $user->save();

        // Redirect back with a success message
        return redirect()->route('team.settings', $user->id)->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function member_store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,superadmin,teacher,agent',
            'email' => 'required|email|unique:users,email',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Set default profile image if not provided
        // $defaultProfileImage = 'profile_images/setting-profile-img.webp'; // Path to default profile image

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'user_type' => $validatedData['role'],  // Assuming 'role' field corresponds to 'user_type'
            'country' => $validatedData['country'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'password' => Hash::make($validatedData['password']),
            // 'profile_image' => $defaultProfileImage, // Assign the default profile image
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Member created successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Member deleted successfully!');
    }

    public function block(User $user)
    {
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('success', 'Member has been disabled successfully.');
    }

    public function unblock(User $user)
    {
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('success', 'Member has been activate successfully.');
    }
}
