<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\AffiliateOption;

class AuthController extends Controller
{
    public function checkPhoneExists(Request $request)
    {
        $phone = '+' . $request->input('country_code') . $request->input('phone');
        $userExists = User::where('phone', $phone)->exists();
        $user = User::whereIn('user_type', ['customer', 'seller'])
                ->where('phone', $phone)
                ->first();
        // Check if password is provided
        if ($request->filled('password') && $user) {
            // If user exists and password is correct, log in
            
            if ($user && Hash::check($request->password, $user->password)) {
                if ($request->has('remember')) {
                    auth()->login($user, true);
                } else {
                    auth()->login($user, false);
                }
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['error' => 'Invalid phone number or password!']);
            }
        }

        // If password is not provided and user does not exist, create new user
        if (!$userExists) {
            if(AffiliateOption::where('type', 'user_registration_first_purchase')->first()->status){
                $balance = AffiliateOption::where('type', 'user_registration_first_purchase')->first()->percentage??0;
            }
            $user = User::create([
                'phone' => $phone,
                'balance'=> $balance,
                'name' => $request->input('name'),
                'password' => Hash::make($request->input('password')),
                'verification_code' => rand(100000, 999999),
                "email_verified_at" => date('Y-m-d H:m:s')
            ]);

            // Send OTP
            // Log::info('OTP is sent');
            $otpController = new OTPVerificationController;
            $otpController->send_code($user);
        }else {
            /*
            if($user->name == "") {
                // Log::info('OTP is sent');
            $otpController = new OTPVerificationController;
            $otpController->send_code($user);
                $userExists = false;
            }
            */
        }

        // Return response indicating whether phone number exists
        return response()->json(['exists' => $userExists]);
    }

    public function loginUser(Request $request)
    {
        $phone = '+' . $request->input('country_code') . $request->input('phone');
        $user = User::where('phone', $phone)->first();

        if ($user) {
            if ($user->verification_code == $request->input('otp')) {
                $user->name = $request->input('name');
                $user->password = Hash::make($request->input('password'));
                $user->save();
                if ($request->has('remember')) {
                    auth()->login($user, true);
                } else {
                    auth()->login($user, false);
                }
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['error' => 'OTP is wrong']);
            }
        } else {
            return response()->json(['error' => 'Invalid phone number!']);
        }
    }
    
    public function checkOTP(Request $request) {
        $user = User::where('phone','+')->first();
        $otpController = new OTPVerificationController;
            $otpController->send_code($user);
    }
}
