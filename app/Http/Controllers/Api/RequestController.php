<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
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
        $data = ModelsRequest::where('code', $request->code)->where('branch_id', $request->branch_id)->where('auditor_id', auth()->user()->id)->first();
        if($data)
        {
            $res['request'] = $data;
            $sections = json_decode($data->section_id, true);
            
            foreach($sections as $sectionID)
            {
                $res['sections'] = Section::with('questions')->where('id', $sectionID)->first();
            }
            return response()->json([
                'status' => 1,
                'data' => $res
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'msg' => 'Invalid user or code'
            ]);
        }
    }
}
