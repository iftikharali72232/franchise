<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\City;

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

    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_no' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
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
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Branch added successfully!',
            'branch' => $branch,
        ]);
    }
    public function show($id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['error' => 'Branch not found'], 404);
        }

        return response()->json($branch);
    }

}
