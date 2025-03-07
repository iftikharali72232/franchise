<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Branch;
use App\Models\Letter;
use App\Mail\LetterMail;

class LetterController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all cities and branches for filters
        $branches = Branch::all();
        $cities = Branch::distinct()->pluck('city');

        // Fetch letters with filters
        $letters = Letter::with('branch')
            ->when($request->city, function ($query, $city) {
                return $query->whereHas('branch', function ($q) use ($city) {
                    $q->where('city', $city);
                });
            })
            ->when($request->branch, function ($query, $branch) {
                return $query->where('branch_id', $branch);
            })
            ->when($request->from, function ($query, $from) {
                return $query->whereDate('created_at', '>=', $from);
            })
            ->when($request->to, function ($query, $to) {
                return $query->whereDate('created_at', '<=', $to);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('letters.index', compact('letters', 'branches', 'cities'));
    }
    public function show($id)
    {
        $letter = Letter::with('branch')->findOrFail($id);
        return view('letters.show', compact('letter'));
    }
    public function create()
    {
        $branches = Branch::where('status', 1)->get();
        return view('letters.create', compact('branches'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'offer_title' => 'required|string|max:255',
            'offer_message' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $branch = Branch::findOrFail($request->branch_id);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $destinationPath = public_path('attachments'); // Path to save the file
            $fileName = time() . '_' . $file->getClientOriginalName(); // Generate a unique filename
            $file->move($destinationPath, $fileName); // Move the file
            $attachmentPath = 'attachments/' . $fileName; // Store the relative path
        }

        $letter = Letter::create([
            'branch_id' => $branch->id,
            'branch_name' => $branch->branch_name,
            'owner_email' => $branch->owner_email,
            'offer_title' => $request->offer_title,
            'offer_message' => $request->offer_message,
            'attachment' => $attachmentPath,
        ]);

        Mail::to($branch->owner_email)->send(new LetterMail($letter));

        return back()->with('success', 'Email sent and letter saved successfully!');
    }

}
