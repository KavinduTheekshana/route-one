<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
        $defaultProfileImage = 'profile_images/setting-profile-img.webp'; // Path to default profile image

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'user_type' => $validatedData['role'],  // Assuming 'role' field corresponds to 'user_type'
            'country' => $validatedData['country'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'password' => Hash::make($validatedData['password']),
            'profile_image' => $defaultProfileImage, // Assign the default profile image
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Member created successfully!');
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
