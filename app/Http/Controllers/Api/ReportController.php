<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ReportResult;

class ReportController extends Controller
{
    // Store or get the main report
    public function storeReport(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'branch_id' => 'required|integer',
            'request_id' => 'required|integer',
        ]);

        // Find or create the report
        $report = Report::firstOrCreate([
            'branch_id' => $validated['branch_id'],
            'request_id' => $validated['request_id'],
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'message' => 'Report retrieved or created successfully.',
            'report' => $report,
        ], 200);
    }

    // Store report results (answers and attachments)
    public function storeReportResult(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'report_id' => 'required|integer|exists:reports,id',
            'section_id' => 'required|integer',
            'question_id' => 'required|integer',
            'answer' => 'nullable|string',
            'images.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Validate each image
        ]);

        $attachments = [];

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('sections'), $imageName);
                $attachments[] = 'sections/' . $imageName; // Save relative paths
            }
        }

        // Find or create the report result
        $reportResult = ReportResult::updateOrCreate(
            [
                'report_id' => $validated['report_id'],
                'section_id' => $validated['section_id'],
                'question_id' => $validated['question_id'],
            ],
            [
                'answer' => $request->answer,
                'attachments' => !empty($attachments) ? json_encode($attachments) : null, // Save as JSON
            ]
        );

        return response()->json([
            'message' => 'Report result stored successfully.',
            'report_result' => $reportResult,
        ], 200);
    }

    public function exitReport(Request $request)
    {
        $validated = $request->validate([
            'report_id' => 'required|int'
        ]);

        $report = Report::where('id', $request->report_id)->update([
            'status' => 1
        ]);
       
        return response()->json([
            'status' => 'success',            'msg' => 'Report submited successfully'
        ]);
    }
}
