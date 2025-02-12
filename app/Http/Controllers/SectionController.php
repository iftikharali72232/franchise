<?php
namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SectionQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('questions')->get(); // Fetch sections with their questions
        // print_r($sections); exit;
        return view('sectionList.index', compact('sections'));
    }
    public function create()
    {
        return view('sectionList.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'shows_to' => 'required|string',
            'image' => 'nullable|image|max:10240', // Max 10MB
            'questions' => 'array',
            'questions.*.question' => 'nullable|string',
            'questions.*.answer1' => 'nullable|string',
            'questions.*.answer2' => 'nullable|string',
            'questions.*.answer3' => 'nullable|string',
        ]);

        $imagePath = "";
        // Handle image upload
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('sections'), $imageName);
            $imagePath = public_path('sections')."/".$imageName;
        }

        // Create section
        $section = Section::create([
            'name' => $data['name'],
            'image_path' => $imagePath,
        ]);

        // Create questions
        foreach ($data['questions'] ?? [] as $questionData) {
            $section->questions()->create($questionData);
        }

        return redirect()->route('sectionList.index')->with('success', 'Section created successfully!');
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('sectionList.edit', compact('section'));
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);

        // Optional: Delete related questions if necessary
        $section->questions()->delete();

        $section->delete();

        return redirect()->route('sectionList.index')->with('success', 'Section deleted successfully.');
    }
    public function show($id)
    {
        $section = Section::with('questions')->findOrFail($id);
        return view('sectionList.show', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'shows_to' => 'required|string',
            'image' => 'nullable|image|max:10240',
            'questions' => 'array',
            'questions.*.question' => 'nullable|string',
            'questions.*.answer1' => 'nullable|string',
            'questions.*.answer2' => 'nullable|string',
            'questions.*.answer3' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($section->image_path) {
                Storage::disk('public')->delete($section->image_path);
            }

            $section->image_path = $request->file('image')->store('sections', 'public');
        }

        // Update section
        $section->update([
            'name' => $data['name'],
            'shows_to' => $data['shows_to'],
            'image_path' => $section->image_path,
        ]);

        // Update questions
        $section->questions()->delete(); // Remove old questions
        foreach ($data['questions'] ?? [] as $questionData) {
            $section->questions()->create($questionData);
        }

        return redirect()->route('sectionList.index')->with('success', 'Section updated successfully!');
    }
    public function setDefaultSection($id)
    {
        // Remove default from any existing section
        Section::where('default_section', 1)->update(['default_section' => 0]);

        // Set the selected section as default
        $section = Section::findOrFail($id);
        // print_r($section); exit;
        $section->update(['default_section' => 1]);

        return redirect()->back()->with('success', 'Default section updated successfully.');
    }

}
