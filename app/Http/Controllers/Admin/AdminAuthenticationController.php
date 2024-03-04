<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminSendResetLinkMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminResetPasswordRequest;
use App\Http\Requests\SendResetLinkRequest;

class AdminAuthenticationController extends Controller
{
    public function login() {
        return view('admin.auth.login');
    }

    public function handleLogin(AdminLoginRequest $request) {

        $request->authenticate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request) {

         Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLink(SendResetLinkRequest $request)
    {
        $token = \Str::random(64);

        $admin = Admin::where('email' , $request->email)->first();
        $admin->remember_token = $token;
        $admin->save();

        Mail::to($request->email)->send(new AdminSendResetLinkMail($token , $request->email));

        return redirect()->back()->with('success' , __('admin_localize.A Mail has been sent to your email address please check'));
    }

    public function create($token) {
        return view('admin.auth.reset-password' , compact('token'));
    }

    public function store(AdminResetPasswordRequest $request)
    {
        $admin = Admin::where(['email' => $request->email , 'remember_token' => $request->token])->first();
        if(!$admin)
        {
            return back()->with('error' , __('admin_localize.token is invalid'));
        }

        $admin->password = bcrypt($request->password);
        $admin->remember_token = null;
        $admin->save();

        return redirect()->route('admin.login')->with('success' , __('admin_localize.Password reset successfully'));
    }
}
