<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $title = "Profile BKK";
            $user = auth()->user();
            return view("profile", compact('title', 'user'));
        } else {
            return redirect('/dont-have-access');
        }
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');

        // Check if the 'name' field is not empty
        if ($request->input('name')) {
            $user->name = $request->input('name');
        } else {
            return redirect()->back()->with('error', 'Name field cannot be empty');
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function profileImageUpdate(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('public/profile_images');
            $user->profile_image_path = $imagePath;
            $user->save();
            return redirect()->back()->with('success', 'Profile image updated successfully');
        } else {
            return redirect()->back()->with('error', 'No file was uploaded');
        }
    }
}
