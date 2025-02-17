<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Report;
use App\Models\ReportResult;
use App\Models\Request as ModelsRequest;
use App\Models\Section;
use App\Models\SectionQuestion;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        // Retrieve all reports with their related branch and request to reduce queries
        $reports = Report::where('status', 1)
            ->with(['branch', 'request'])
            ->get();
        $res = [];
        foreach ($reports as $key => $report) {
            // Check if branch and location exist
            if ($report->branch && $report->branch->location) {
                $latLong = explode(',', $report->branch->location);

                // Ensure we have valid latitude and longitude
                if (count($latLong) === 2) {
                    $branch_location = getCityFromCoordinates($latLong[0], $latLong[1], 1);
                } else {
                    $branch_location = 'Location not available';
                }
            } else {
                $branch_location = 'Location not available';
            }

            // Check if request exists and decode sections safely
            if ($report->request && $report->request->section_id) {
                $sectionIds = json_decode($report->request->section_id, true);

                // Ensure $sectionIds is an array
                if (is_array($sectionIds)) {
                    $sections = Section::whereIn('id', $sectionIds)->pluck('name');
                } else {
                    $sections = collect(['No sections available']);
                }
            } else {
                $sections = collect(['No sections available']);
            }

            $report['branch_location'] = $branch_location;
            $report['section'] = $sections;
            $res[] = $report;
        }
        // echo "<pre>";    print_r($res); exit;
        return view('reports_all', compact('res'));
    }
    // Show a specific report by ID
    public function show($id)
{
    // Retrieve the report by ID
    $report = Report::where('status', 1)->with(['branch', 'request'])->first();

    if ($report) {
        // Calculate branch location
        $branch_location = 'Location not available';
        if ($report->branch && $report->branch->location) {
            $latLong = explode(',', $report->branch->location);
            if (count($latLong) === 2) {
                $branch_location = getCityFromCoordinates($latLong[0], $latLong[1], 1);
            }
        }

        // Decode section IDs
        $sectionsArray = [];
        if ($report->request && $report->request->section_id) {
            $sectionIds = json_decode($report->request->section_id, true);
            $sections = is_array($sectionIds)
                ? Section::whereIn('id', $sectionIds)->get()
                : collect();

            foreach ($sections as $section) {
                $questions = ReportResult::where('section_id', $section->id)
                    ->where('report_id', $id)
                    ->get(['question_id', 'answer', 'attachments']);

                $questionDetails = [];
                foreach ($questions as $q) {
                    $question = SectionQuestion::find($q->question_id);
                    if ($question) {
                        $questionDetails[] = [
                            'question'    => $question->question ?? 'Unknown',
                            'answer'      => $q->answer,
                            'attachments' => $q->attachments
                        ];
                    }
                }

                $sectionsArray[] = [
                    'section_name' => $section->name,
                    'questions'    => $questionDetails,
                ];
            }
        }

        // Prepare report details
        $reportDetails = [
            'branch_location' => $branch_location,
            'sections'        => $sectionsArray,
            'results'         => ReportResult::where('report_id', $id)->get(),
            'user'            => User::find($report->user_id),
        ];

        return view('reports_detail', compact('reportDetails'));
    }

    // Handle case when report not found
    return redirect()->back()->with('error', 'Report not found.');
}

}
