<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6|confirmed',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    // Update user details
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('image')) {
        // Delete old image if exists
        $oldImagePath = public_path('profile_images/' . $user->image);
        if ($user->image && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        // Store new image in `public/profile_images/`
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('profile_images'), $imageName);

        // Save image path in the database
        $user->image = 'profile_images/' . $imageName;
    }

    $user->notification_status = $request->has('notification_status') ? 1 : 0;
    $user->save();

    return back()->with('success', 'Profile updated successfully!');
}

}
