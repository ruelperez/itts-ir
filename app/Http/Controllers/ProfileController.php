<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store the file in the public/profile_pictures directory
            $file->move(public_path('profile_pictures'), $filename);

            // Optionally, update the user's profile picture in the database
            $user = Auth::user();
            $user->photo = $filename; // Adjust this field as per your database structure
            $user->save();
        }

        return back()->with('success', 'Profile picture uploaded successfully.');
    }
}
