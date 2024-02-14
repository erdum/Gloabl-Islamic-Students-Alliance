<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Stevebauman\Location\Facades\Location;

use App\Models\User;
use App\Models\Country;

class AuthController extends Controller
{
    public function login()
    {
        return view('layout.login');
    }

    public function signup()
    {
        return view('layout.signup');
    }

    public function handle_login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);
        $unverified_user = User::where('email', $request->email)
            ->where('email_verified_at', null)->first();

        if ($unverified_user) {
            $unverified_user->otp = rand(100000, 999999);
            $unverified_user->save();
            $this->send_otp($unverified_user->email, $unverified_user->otp);

            return redirect()->route('verify-otp');
        }

        if (Auth::attempt($validated, (boolean) $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials!',
            'password' => 'Invalid credentials!'
        ])->withInput();
    }

    public function handle_signup(Request $request)
    {
        $country_code = Location::get()->countryCode;
        $country_id = Country::where('code', $country_code)->first()?->id;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'gender' => 'required',
            'password' => 'required',
        ]);

        if (
            User::where('email', $request->email)
            ->where('email_verified_at', '<>', null)->count() > 0
        ) {

            return redirect()->back()->withErrors([
                'email' => 'User account already exists with this email!'
            ])->withInput();
        }

        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'country_id' => $country_id
            ]
        );

        if ($request->hasFile('avatar')) {
            $user->avatar = save_img_to_webp(
                $request->avatar,
                'users-avatars/'
            );
        }
        $user->otp = rand(100000, 999999);
        $user->save();
        $this->send_otp($user->email, $user->otp);

        return redirect()->route('verify-otp');
    }

    public function verify_otp()
    {
        return view('layout.verify-otp');
    }

    public function handle_otp(Request $request)
    {
        $request->validate([
            'otp' => 'required|exists:users,otp'
        ], [
            'otp.exists' => 'Invalid OTP code!'
        ]);

        $user = User::where('otp', $request->otp)->first();
        $user->otp = null;
        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/');
    }

    public function forget_password()
    {
        return view('layout.forget-password');
    }

    public function handle_forgotten_password(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email|email:rfc,dns'
        ], [
            'email.exists' => 'Invalid Email!'
        ]);

        $user = User::where('email', $request->email)->first();
        $user->otp = rand(100000, 999999);
        $user->save();
        $this->send_otp($user->email, $user->otp);

        return redirect()->route('reset-password');
    }

    public function reset_password()
    {
        return view('layout.reset-password');
    }

    public function handle_reset_password(Request $request)
    {
        $request->validate(
            [
                'otp' => 'required|exists:users,otp',
                'new_password' => 'required',
            ],
            ['otp.exists' => 'Invalid OTP code!']
        );

        $user = User::where('otp', $request->otp)->first();
        $user->password = Hash::make($request->new_password);
        $user->otp = null;
        $user->save();

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function send_otp($user_email, $otp)
    {
        Mail::raw("Hi, welcome user!\nYour OTP code is $otp", function ($message) use ($user_email) {
          $message->to($user_email)
            ->subject('OTP | ' . config('app.name'));
        });
    }
}
