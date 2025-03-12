<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Report;
use App\Models\ReportResult;
use App\Models\Section;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     
     public function index(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->user_type != 0) {
                Auth::logout();
                return redirect()->route('login')->with('error', trans('lang.not_valid_user'));
            }
        }

        // Request se filters ko retrieve karein
        $selectedSectionID = $request->input('section', null);
        $selectedRegion = $request->input('region', 'Madinah'); // Default value

        // Sections ko retrieve karein
        $sections = Section::select("id", "name", "default_section")->get();

        // Agar koi section select nahi kiya gaya, to default section ka ID lein
        if (!$selectedSectionID) {
            $defaultSection = Section::where('default_section', 1)->first();
            $selectedSectionID = $defaultSection ? $defaultSection->id : null;
        }

        // Filtration apply karein
        $branches = Branch::where("region", $selectedRegion)->get();
        $members = User::where('user_type', 1)->get();
        $sidebranches = Branch::where('status', 1)->take(5)->get();

        // Data series array initialize karein
        $series = [];
        $year = date('Y');

        // Har branch ke liye data calculate karein
        foreach ($branches as $branch) {
            $monthlyPercentages = [];
            for ($month = 1; $month <= 12; $month++) {
                $reports = Report::where('branch_id', $branch->id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->get();

                $totalScore = 0;
                $totalQuestions = 0;

                if ($reports->count() > 0) {
                    foreach ($reports as $report) {
                        // Agar section select nahi hua to skip karein
                        if (!$selectedSectionID) {
                            continue;
                        }
                        $reportResults = ReportResult::where('report_id', $report->id)
                            ->where('section_id', $selectedSectionID)
                            ->get();

                        foreach ($reportResults as $result) {
                            $totalQuestions++;
                            switch ($result->answer) {
                                case 'Unacceptable':
                                    $totalScore += 0;
                                    break;
                                case 'Average':
                                    $totalScore += 10;
                                    break;
                                case 'Excellent':
                                    $totalScore += 20;
                                    break;
                            }
                        }
                    }
                }

                $percentage = ($totalQuestions > 0) ? ($totalScore / ($totalQuestions * 20)) * 100 : 0;
                $monthlyPercentages[] = $percentage;
            }

            $series[] = [
                'name' => $branch->branch_name ?? 'N/A',
                'data' => $monthlyPercentages,
            ];
        }

        return view('home', compact('sections', 'branches', 'members', 'sidebranches', 'series', 'selectedSectionID', 'selectedRegion'));
    }

     
     

    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', ['user' => $user]);
    }
}
