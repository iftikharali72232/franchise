<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\City;
use Illuminate\Support\Facades\Log;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all(); // Retrieve all branches
        $cities = City::where('status', 1)->pluck('city_name', 'sno'); // Fetch active cities
        return view('branches.index', compact('branches', 'cities'));
    }
    public function list()
    {
        $branches = Branch::all(); // Fetch all branches or apply filters if needed
        return response()->json($branches);
    }

    public function create()
    {
        $cities = City::where('status', 1)->pluck('city_name', 'sno'); // Fetch active cities
        return view('branches.create', compact('cities'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_no' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'owner_email' => 'required|email',
            'header_image' => 'nullable|image|max:102400', // 100MB max size
        ]);
    
        $headerImage = null;
    
        if ($request->hasFile('header_image')) {
            $image = $request->file('header_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $headerImage = $imageName;
        }
    
        $branch = Branch::create([
            'branch_name' => $request->input('branch_name'),
            'branch_no' => $request->input('branch_no'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),
            'location' => $request->input('location'),
            'header_image' => $headerImage,
            'owner_email' => $request->input('owner_email')
        ]);
    
       return redirect()->route('branches.index');
    }
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        $cities = City::where('status', 1)->pluck('city_name', 'sno'); // Fetch active cities
        return view('branches.show', compact('branch', 'cities'));
    }

    public function edit($id)
{
    $branch = Branch::findOrFail($id);
    $cities = City::where('status', 1)->pluck('city_name', 'sno'); // Fetch active cities
    return view('branches.edit', compact('branch', 'cities'));
}


public function update(Request $request, $id)
{
    
    try {
        Log::info('Updating branch ID: ' . $id, $request->all());

        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_no' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'owner_email' => 'required|email',
            'header_image' => 'nullable|image|max:102400',
        ]);

        $branch = Branch::findOrFail($id);

        if ($request->hasFile('header_image')) {
            $image = $request->file('header_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            if ($branch->header_image) {
                $oldImagePath = public_path('uploads/' . $branch->header_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $branch->header_image = $imageName;
        }

        $branch->update([
            'branch_name' => $request->input('branch_name'),
            'branch_no' => $request->input('branch_no'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),
            'location' => $request->input('location'),
            'owner_email' => $request->input('owner_email'),
            'header_image' => $branch->header_image,
        ]);

        Log::info('Branch updated successfully: ' . $id);

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully!');
    } catch (\Exception $e) {
        Log::error('Error updating branch: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}



}
