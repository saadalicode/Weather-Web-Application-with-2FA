<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


class TwoFactorController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function index()
    {
        $user = User::find(Auth::id());

        // Check if OTP has expired
        if ($user->two_factor_expires_at && now()->greaterThan($user->two_factor_expires_at)) {
            // Reset OTP to 0 if expired
            $user->two_factor_code = 0; // Use 0 instead of NULL
            $user->two_factor_expires_at = null;
            $user->save();
        }

        // Generate a new OTP if it's 0 or never set
        if ($user->two_factor_code == 0) {
            $code = rand(100000, 999999);
            $user->two_factor_code = $code;
            $user->two_factor_expires_at = now()->addMinutes(5); // OTP expires in 5 minutes
            $user->save();

            Mail::raw("Your new two-factor code is $code", function ($message) use ($user) {
                $message->to($user->email)->subject('New Two-Factor Code');
            });
        }

        return view('auth.two-factor');
    }

    
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ]);

        $user = User::find(Auth::id());

        // Ensure two_factor_expires_at is not null before checking expiration
        if (!$user->two_factor_expires_at || now()->greaterThan($user->two_factor_expires_at)) {
            return redirect()->route('two-factor.index')->withErrors(['code' => 'The OTP has expired. Please request a new one.']);
        }

        // Check if entered OTP matches
        if ($request->code == $user->two_factor_code) {
            session(['two_factor_authenticated' => true]);

            // Clear the OTP after successful verification
            $user->two_factor_code = 0;
            $user->two_factor_expires_at = null;
            $user->save();

            return redirect()->intended('/dashboard');
        }

        return redirect()->route('two-factor.index')->withErrors(['code' => 'The provided code is incorrect.']);
    }


}
