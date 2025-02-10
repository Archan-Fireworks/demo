<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;
use DB;

class OTPVerificationController extends Controller
{
    public function send_code(User $user)
    {
        $verificationCode = $user->verification_code;

        $text = $verificationCode;
        // Log::info('OTP is sent in send_code');
        sendSMS($user->phone, $from = "", $text, $template_id=null);
    }

    public function send_otp($phone)
    {
        $verificationCode = $user->verification_code;

        $text = "Your OTP is ".$verificationCode;
        sendSMS($user->phone, $from = "", $text, $template_id=null);
    }

    public function verification($code)
    {
        $user = User::where('verification_code', $code)->first();
        if($user != null){
            auth()->login($user, true);
            flash(translate('Your phone has been verified successfully'))->success();
        }
        else {
            flash(translate('Sorry, we could not verifiy you. Please try again'))->error();
        }

        if($user->user_type == 'seller') {
            return redirect()->route('seller.dashboard');
        }

        return redirect()->route('dashboard');
    }
    
    public function generate_otp($phone) {
        // Validate phone
            $request->validate([
                'phone' => 'required|numeric',
            ]);
        
            // Generate OTP (you can customize this as per your requirement)
            $otp = mt_rand(100000, 999999); // Generate a random 6-digit OTP
        
            // Save OTP to the database
            $otpEntry = new Otp;
            $otpEntry->phone = $request->phone;
            $otpEntry->otp = $otp;
            $otpEntry->save();
        
            sendSMS($user->phone, $from = "", $otp, $template_id=null);
            
            return response()->json([
                'status' => 'success'
            ]);
    }

    public function verify_phone(Request $request)
    {
        // Implement your phone verification logic here
    }

    public function resend_verification_code()
    {
        // Implement your code for resending the verification code here
    }

    public function show_reset_password_form()
    {
        // Implement your reset password form view rendering logic here
    }

    public function reset_password_with_code(Request $request)
    {
        $phone = str_replace(' ','',"+{$request['country_code']}{$request['phone']}");
        if (($user = User::where('phone', $phone)->where('verification_code', $request->code)->first()) != null) {
            if ($request->password == $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->email_verified_at = date('Y-m-d h:m:s');
                $user->save();
                event(new PasswordReset($user));
                auth()->login($user, true);

                flash(translate('Password updated successfully'))->success();

                if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('home');
            } else {
                flash(translate("Password and confirm password didn't match"))->warning();
                return view('auth.passwords.reset_with_phone', compact('user','phone'));
            }
        } else {
            flash(translate("OTP is mismatch"))->error();
            return view('auth.passwords.reset_with_phone',compact('user','phone'));
        }
    }
}
