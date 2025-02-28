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
            $imagePath = 'sections/' . $imageName;
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

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        // echo "<pre>"; print_r($section); exit;

        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'questions.*.question' => 'required|string|max:500',
            'questions.*.answer1' => 'required|string|max:255',
            'questions.*.answer2' => 'required|string|max:255',
            'questions.*.answer3' => 'required|string|max:255',
        ]);

        // Update section name
        $section->name = $request->name;

        // Handle Image Deletion
        if ($request->has('delete_image') && $request->delete_image == "1") {
            if ($section->image_path && file_exists(public_path('sections/' . basename($section->image_path)))) {
                unlink(public_path('sections/' . basename($section->image_path))); // Delete file
            }
            $section->image_path = null;
        }

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image first if exists
            if ($section->image_path && file_exists(public_path('sections/' . basename($section->image_path)))) {
                unlink(public_path('sections/' . basename($section->image_path)));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('sections'), $imageName);
            $section->image_path = 'sections/' . $imageName;
        }

        
        $section->save();

        // Handle Questions
        if ($request->has('questions')) {
            foreach ($request->questions as $key => $data) {
                // If question ID exists, update existing question
                if (isset($data['id'])) {
                    $question = SectionQuestion::find($data['id']);
                    if ($question) {
                        $question->update([
                            'question' => $data['question'],
                            'answer1' => $data['answer1'],
                            'answer2' => $data['answer2'],
                            'answer3' => $data['answer3'],
                        ]);
                    }
                } 
                // Otherwise, it's a new question, so create it
                else {
                    SectionQuestion::create([
                        'section_id' => $section->id,
                        'question' => $data['question'],
                        'answer1' => $data['answer1'],
                        'answer2' => $data['answer2'],
                        'answer3' => $data['answer3'],
                    ]);
                }
            }
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
