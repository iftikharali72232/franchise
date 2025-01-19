<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use App\Models\User;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('user_type', 1)->get(); // Fetch sections with their questions
        return view('members.index', compact('members'));
    }
    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20',
                'email' => 'required|email|unique:members,email',
                'password' => 'required|string|min:6',
                'function' => 'required|string',
                'job_number' => 'nullable|string|max:100',
                'face_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string',
            ]);

            // Create a new user instance
            $member = new User();
            $member->name = $validated['name'];
            $member->mobile = $validated['phone_number'];
            $member->email = $validated['email'];
            $member->password = Hash::make($validated['password']);
            $member->function = $validated['function'];
            $member->job_number = $validated['job_number'] ?? null;
            $member->description = $validated['description'] ?? null;
            $member->user_type = 1;

            // Handle file upload for 'face_id'
            if ($request->hasFile('face_id')) {
                $image = $request->file('face_id');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('face_id'), $imageName);
                $member->face_id = 'face_id/' . $imageName;
            }

            // Save the member
            $member->save();

            // Redirect with success message
            return redirect()->route('members.index')->with('success', 'Member added successfully.');
        } catch (\Exception $e) {
            // Display the error message
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $member = User::findOrFail($id);
        return view('members.edit', compact('member'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|unique:members,email,' . $id,
            'function' => 'required|string',
            'job_number' => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);
        
        $member = User::findOrFail($id);
        $member->update($validated);
    
        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }
    public function destroy($id)
    {
        $member = User::findOrFail($id);
        $member->delete();
    
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }



}
