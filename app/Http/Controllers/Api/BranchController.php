<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    // List all branches
    public function index()
    {
        return response()->json(Branch::all());
    }

    // Add a new branch
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_name' => 'required|string',
            'branch_no' => 'required|string',
            'region' => 'required|string',
            'city' => 'required|string',
            'location' => 'required|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Optional image
            'status' => 'boolean',
        ]);

        if ($request->hasFile('header_image')) {
            $validated['header_image'] = $request->file('header_image')->store('branches');
        }

        $branch = Branch::create($validated);

        return response()->json(['message' => 'Branch created successfully', 'data' => $branch], 201);
    }

    // Update an existing branch
    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $validated = $request->validate([
            'branch_name' => 'nullable|string',
            'branch_no' => 'nullable|string',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'location' => 'nullable|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('header_image')) {
            $validated['header_image'] = $request->file('header_image')->store('branches');
        }

        $branch->update($validated);

        return response()->json(['message' => 'Branch updated successfully', 'data' => $branch]);
    }

    // Delete a branch
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return response()->json(['message' => 'Branch deleted successfully']);
    }
}
