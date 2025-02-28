<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Branch;
use App\Models\Report;
use App\Models\ReportResult;
use App\Models\Request as ModelsRequest;
use App\Models\Section;
use App\Models\SectionQuestion;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    //
    public function index()
    {
        // Retrieve all reports with their related branch and request to reduce queries
        $reports = Report::with('user')->where('status', 1)
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
        $report = Report::with('user')->where('status', 1)->where('id', $id)
            ->with(['branch', 'request'])
            ->first();

        if ($report) {
            // Check if branch and location exist
            if ($report->branch && $report->branch->location) {
                $latLong = explode(',', $report->branch->location);

                // Ensure we have valid latitude and longitude
                $branch_location = (count($latLong) === 2)
                    ? getCityFromCoordinates($latLong[0], $latLong[1], 1)
                    : 'Location not available';
            } else {
                $branch_location = 'Location not available';
            }
            // echo "<pre>";print_r(ModelsRequest::find($report->request_id)); exit;
            $report->request = ModelsRequest::find($report->request_id);
            // Check if request exists and decode sections safely
            if ($report->request && $report->request->section_id) {
                $sectionIds = json_decode($report->request->section_id, true);
                // print_r($sectionIds); exit;
                $sections = is_array($sectionIds)
                    ? Section::whereIn('id', $sectionIds)->get()
                    : collect([]);
            } else {
                $sections = collect([]);
            }
            // echo "<pre>";
            // print_r($sections);
            // exit;
            $sectionsArray = [];
            if ($sections->count() > 0) {
                foreach ($sections as $sk => $sec) {
                    $questionId = ReportResult::where('section_id', $sec->id)->where('report_id', $id)->get(['question_id', 'answer', 'attachments']);
                    // echo "<pre>";print_r($questionId); exit;
                    if ($questionId->count() > 0) {
                        foreach ($questionId as $q) {
                            $question = SectionQuestion::where('id', $q->question_id)->first();
                            $question['answer'] = $q->answer;
                            $question['attachments'] = $q->attachments;
                            $sec['questions'][] = $question;
                        }
                    }
                    $sectionsArray[] = $sec;
                }
            }
            // echo "<pre>";
            // print_r($sectionsArray);
            // exit;
            // Add additional data using object properties
            $report->branch_location = $branch_location;
            $report->sections = $sections;

            $results = ReportResult::where('report_id', $id)->get();
            $report->results = $results;

            // Debugging output
            // echo "<pre>";
            // print_r($report->toArray());
            // exit;

            // Pass the report to the view
            return view('reports_detail', compact('report'));
        }

        // Handle case when report not found
        return redirect()->back()->with('error', 'Report not found.');
    }

    public function report_view($id)
    {
        $id = base64_decode($id);
        // Retrieve the report by ID
        $report = Report::where('status', 1)->where('id', $id)
            ->with(['branch', 'request'])
            ->first();

        if ($report) {
            // Check if branch and location exist
            if ($report->branch && $report->branch->location) {
                $latLong = explode(',', $report->branch->location);

                // Ensure we have valid latitude and longitude
                $branch_location = (count($latLong) === 2)
                    ? getCityFromCoordinates($latLong[0], $latLong[1], 1)
                    : 'Location not available';
            } else {
                $branch_location = 'Location not available';
            }
            // echo "<pre>";print_r(ModelsRequest::find($report->request_id)); exit;
            $report->request = ModelsRequest::find($report->request_id);
            // Check if request exists and decode sections safely
            if ($report->request && $report->request->section_id) {
                $sectionIds = json_decode($report->request->section_id, true);
                // print_r($sectionIds); exit;
                $sections = is_array($sectionIds)
                    ? Section::whereIn('id', $sectionIds)->get()
                    : collect([]);
            } else {
                $sections = collect([]);
            }
            // echo "<pre>";
            // print_r($sections);
            // exit;
            $sectionsArray = [];
            if ($sections->count() > 0) {
                foreach ($sections as $sk => $sec) {
                    $questionId = ReportResult::where('section_id', $sec->id)->where('report_id', $id)->get(['question_id', 'answer', 'attachments']);
                    // echo "<pre>";print_r($questionId); exit;
                    if ($questionId->count() > 0) {
                        foreach ($questionId as $q) {
                            $question = SectionQuestion::where('id', $q->question_id)->first();
                            $question['answer'] = $q->answer;
                            $question['attachments'] = $q->attachments;
                            $sec['questions'][] = $question;
                        }
                    }
                    $sectionsArray[] = $sec;
                }
            }
            // echo "<pre>";
            // print_r($sectionsArray);
            // exit;
            // Add additional data using object properties
            $report->branch_location = $branch_location;
            $report->sections = $sections;

            $results = ReportResult::where('report_id', $id)->get();
            $report->results = $results;
            $report->user = User::find($report->user_id);

            // Debugging output
            // echo "<pre>";
            // print_r($report->toArray());
            // exit;

            // Pass the report to the view
            return view('report_view', compact('report'));
        }

        // Handle case when report not found
        return redirect()->back()->with('error', 'Report not found.');
    }
    public function generatePdf(Request $request)
    {
        $html = $request->html;
        $pdf = PDF::loadHTML($html);
        return $pdf->stream('report.pdf');
    }

    public function sendReport(Request $request)
    {
        $request->validate([
            "id" => "required",
            "email" => "required"
        ]);

        $email = $request->email;
        $url = url("/report_view/" . base64_encode($request->id));

        Mail::to($email)->send(new SendEmail($url));

        return response()->json(['message' => 'Email sent successfully!']);
    }
}
