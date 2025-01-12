<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MyMailable;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $otpData = session('otp');
        print_r($otpData); exit;
        if (!$otpData) {
            return response()->json(['message' => 'No OTP found.'], 400);
        }

        // Check if the OTP has expired
        if (now()->greaterThan($otpData['expires_at'])) {
            // Clear the expired OTP
            session()->forget('otp');
            return response()->json(['message' => 'OTP has expired.'], 400);
        }

        // Verify the OTP and email
        if ($otpData['code'] == $request->otp && $otpData['email'] == $request->email) {
            // Clear the OTP after successful verification
            session()->forget('otp');
            return response()->json(['message' => 'OTP verified successfully.']);
        }

        return response()->json(['message' => 'Invalid OTP or email.'], 400);
    }
}
