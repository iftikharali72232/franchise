<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'user_type' => 'required|int',
        ]);
    
        $validated['password'] = Hash::make($validated['password']);
        
        // Generate a random 6-digit OTP
        $otp = random_int(100000, 999999);
        
        // Set OTP expiration (5 minutes from now)
        $validated['otp'] = $otp;
        $validated['otp_expiry'] = now()->addMinutes(5);
        $validated['is_verify'] = 0; // User is not verified yet
        
        // Save the user data along with the OTP
        $user = User::create($validated);
    
        // Send the OTP email
        Mail::to($request->email)->send(new OTPMail($otp));
    
        return response()->json([
            'message' => 'User registered successfully. Please verify your email using the OTP.',
            'user' => $user
        ], 200);
    }

    public function verifyOTP(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $validated['email'])->first();
        // print_r($user->otp); exit;
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }


        if ($user->otp !== $validated['otp']) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        if (now()->greaterThan($user->otp_expiry)) {
            return response()->json(['message' => 'OTP has expired'], 400);
        }

        // Mark the user as verified and clear the OTP
        $user->update([
            'is_verify' => 1,
            'otp' => null,
            'otp_expiry' => null,
        ]);

        return response()->json(['message' => 'OTP verified successfully'], 200);
    }

    public function resendOTP(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
    
        $user = User::where('email', $validated['email'])->first();
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

    
        // Generate a new OTP and update the user record
        $otp = random_int(100000, 999999);
        $user->update([
            'otp' => $otp,
            'otp_expiry' => now()->addMinutes(5),
        ]);
    
        // Send the OTP email
        Mail::to($user->email)->send(new OTPMail($otp));
    
        return response()->json(['message' => 'A new OTP has been sent to your email'], 200);
    }
    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Generate a random 6-digit OTP
        $otp = random_int(100000, 999999);

        // Update the user's OTP and expiry time
        $user->update([
            'otp' => $otp,
            'otp_expiry' => now()->addMinutes(5),
        ]);

        // Send the OTP email
        Mail::to($user->email)->send(new OTPMail($otp));

        return response()->json(['message' => 'An OTP has been sent to your email'], 200);
    }
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            // 'otp' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // if ($user->otp !== (int)$validated['otp']) {
        //     return response()->json(['message' => 'Invalid OTP'], 400);
        // }

        // if (now()->greaterThan($user->otp_expiry)) {
        //     return response()->json(['message' => 'OTP has expired'], 400);
        // }

        // Reset the user's password and clear OTP fields
        $user->update([
            'password' => Hash::make($validated['password']),
            'otp' => null,
            'otp_expiry' => null,
        ]);

        return response()->json(['message' => 'Password reset successfully'], 200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'mobile' => 'numeric|unique:users,mobile,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'user_type' => 'string',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ], 200);
    }
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'user_type' => 'required|integer|in:1,2', // Validate user_type as integer and only allow 1 or 2
        ]);
    
        $user = User::where('email', $validated['email'])
                    ->where('user_type', $validated['user_type'])
                    ->first();
    
        // Check if user exists and password is valid
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid email, password, or user type',
            ], 401);
        }
    
        // Check if user is verified
        if (!$user->is_verify) {
            return response()->json([
                'message' => 'Your account is not verified. Please verify your email.',
            ], 403); // 403 Forbidden
        }
    
        // Check if user is approved by admin
        if ($user->status === 0) {
            return response()->json([
                'message' => 'Your account is not approved by the admin yet.',
            ], 403); // 403 Forbidden
        }
    
        // Generate a token
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'user_type' => $user->user_type,
            ],
        ], 200);
    }
    

}
