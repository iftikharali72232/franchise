<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all(); // Fetch sections with their questions
        return view('members.index', compact('members'));
    }
    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
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

        $member = new Member();
        $member->name = $validated['name'];
        $member->phone_number = $validated['phone_number'];
        $member->email = $validated['email'];
        $member->password = Hash::make($validated['password']);
        $member->function = $validated['function'];
        $member->job_number = $validated['job_number'] ?? null;
        $member->description = $validated['description'] ?? null;

        if($request->hasFile('face_id')){
            $image = $request->file('face_id');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('face_id'), $imageName);
            $member->face_id = public_path('face_id')."/".$imageName;
        }

        $member->save();

        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|unique:members,email,' . $id,
        'function' => 'required|string',
        'job_number' => 'nullable|string|max:100',
        'description' => 'nullable|string',
    ]);

    $member = Member::findOrFail($id);
    $member->update($validated);

    return redirect()->route('members.index')->with('success', 'Member updated successfully.');
}
public function destroy($id)
{
    $member = Member::findOrFail($id);
    $member->delete();

    return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
}


}
