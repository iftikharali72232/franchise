<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\Branch;
use App\Models\City;
use App\Models\Request as ModelsRequest;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function getCodeApproval(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'branch_id' => 'required|int'
        ]);
        $res = [];
        $data = ModelsRequest::where('code', $request->code)
                ->where('branch_id', $request->branch_id)
                ->where('auditor_id', auth()->user()->id)
                ->where('date', date('Y-m-d'))
                ->orderBy('created_at', 'desc') // Yahan 'created_at' ko replace kar sakte hain kisi aur column se
                ->first();
        if($data)
        {
            $res['request'] = $data;
            $sections = json_decode($data->section_id, true);
            $vQ = json_decode($data->questions, true);
            foreach($sections as $sectionID)
            {
                $sss = Section::with('questions')->where('id', $sectionID)->first();
                foreach($sss->questions as $qkey => $qqq)
                {
                    if(!in_array($qqq->id, $vQ))
                    {
                        unset($sss->questions[$qkey]);
                    }
                }
                $res['sections'][] = $sss;
            }
            return response()->json([
                'status' => 1,
                'data' => $res
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => 'Reasons behind your request FALSE!
                        1): User mismatch 
                        2): Code invalid 
                        3): Your visite date is not match with the current date'
            ]);
        }
    }
    public function cityList()
    {
        $cities = City::all();
        return response()->json($cities);
    }
    public function notifications()
    {
        $user = auth()->user();
        if($user->notification_status)
        {
            $reports = ModelsRequest::where('auditor_id', $user->id)->where('is_read', 0)->orderBy('id', 'desc')->get();
            foreach($reports as $key => $report)
            {
                $branch = Branch::find($report->branch_id);
                $reports[$key]['branch'] = $branch;
            }
        } else {
            $reports = [];
        }
        

        return response()->json([
            'data' => $reports
        ]);
    }
    public function readNotification(Request $request)
    {
        $request->validate([
            'flag' => 'required|string',
        ]);
        if($request->flag == 'single')
        {
            $request->validate([
                'request_id' => 'required|int',
            ]);

            ModelsRequest::where('id', $request->request_id)->update([
                'is_read' => 1
            ]);
        } else {
            ModelsRequest::where('auditor_id', auth()->user()->id)->update([
                'is_read' => 1
            ]);
        }
        return response()->json([
            'msg' => 'Notification read successfully'
        ]);
    }

}
