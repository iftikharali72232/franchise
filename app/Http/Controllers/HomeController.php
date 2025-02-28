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
     
         // Fetch data with fallback defaults if needed
         $sections = Section::select("id", "name", "default_section")->get();
         // Get first default section id; if none exists, null is returned.
         $defaultSection = Section::where('default_section', 1)->first();
         $sectionID = $defaultSection ? $defaultSection->id : null;
         
         $branches = Branch::where("region", "Madinah")->get();
         $members = User::where('user_type', 1)->take(5)->get();
         $sidebranches = Branch::where('status', 1)->take(5)->get();
     
         // Initialize an array to store the series data
         $series = [];
         $year = date('Y');
     
         // Loop through each branch
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
                         // If sectionID is null then skip calculating report results
                         if (!$sectionID) {
                             continue;
                         }
                         $reportResults = ReportResult::where('report_id', $report->id)
                             ->where('section_id', $sectionID)
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
     
         return view('home', compact('sections', 'branches', 'members', 'sidebranches', 'series'));
     }
     
     

    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', ['user' => $user]);
    }
}
