<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ReportResult;
use App\Models\Request as ModelsRequest;
use App\Models\Section;
use App\Models\SectionQuestion;

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

        $report = Report::where('branch_id', $validated['branch_id'])->where('request_id', $validated['request_id'])->where('user_id', auth()->user()->id)->first();
        if(!$report)
        {
            // Find or create the report
            $report = Report::firstOrCreate([
                'branch_id' => $validated['branch_id'],
                'request_id' => $validated['request_id'],
                'user_id' => auth()->user()->id
            ]);

        } 

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

    public function reportlist()
    {
        $reports = Report::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        if ($reports->isEmpty()) {
            return response()->json([
                'message' => 'No reports found.'
            ], 404); // Using 404 status for "not found"
        }

        foreach ($reports as $key => $report) {
            $branch = Branch::find($report->branch_id);
            $city = City::find($branch->city ?? null);
            $request = ModelsRequest::find($report->request_id);
            
            $reports[$key]['branch'] = $branch;
            $reports[$key]['city'] = $city;
            $reports[$key]['request'] = $request;
        }

        return response()->json([
            'data' => $reports
        ]);

    }
    public function previousReportApi()
    {
        $reports = Report::where('user_id', auth()->user()->id)->where('status', 1)->orderBy('id', 'desc')->get();
        if ($reports->isEmpty()) {
            return response()->json([
                'message' => 'No reports found.'
            ], 404); // Using 404 status for "not found"
        }
        foreach($reports as $key => $report)
        {
            $branch = Branch::find($report->branch_id);
            $city = City::find($branch->city);
            $request = ModelsRequest::find($report->request_id);
            $reports[$key]['branch'] = $branch;
            $reports[$key]['city'] = $city;
            $reports[$key]['request'] = $request;
        }

        return response()->json([
            'data' => $reports
        ]);
    }

    public function reportDetail(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|int'
        ]);

        $report = Report::find($request->id);
        $branch = Branch::find($report->branch_id);
        $city = City::find($branch->city);
        $request = ModelsRequest::find($report->request_id);

        $report['branch'] = $branch;
        $report['city'] = $city;
        $report['request'] = $request;
        $sections = Section::whereIn('id', json_decode($request->section_id, true))->get();
        foreach($sections as $sKey => $section)
        {
            $questions = SectionQuestion::where('section_id', $section->id)->get();
            foreach($questions as $qKey => $question)
            {
                $questions[$qKey]['result'] = ReportResult::where('question_id', $question->id)->where('report_id', $report->id)->where('section_id', $section->id)->first();
            }
            $sections[$sKey]['questions'] = $questions;
        }
        $report['sections'] = $sections;

        return response()->json([
            'data' => $report
        ]);
    }
}
