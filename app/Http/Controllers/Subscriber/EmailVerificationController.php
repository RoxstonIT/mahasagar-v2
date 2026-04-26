<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function notice(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('superadmin')) {
            return redirect()->route('admin.dashboard');
        }

        if (!$user->hasRole('reader')) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('subscriber.dashboard');
        }

        return view('subscriber.auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        $user = $request->user();

        if ($user->hasRole('superadmin')) {
            return redirect()->route('admin.dashboard');
        }

        if (!$user->hasRole('reader')) {
            abort(403);
        }

        return redirect()
            ->route('subscriber.dashboard')
            ->with('success', 'Email verified successfully.');
    }

    public function resend(Request $request)
    {
        $user = $request->user();

        if (!$user->hasRole('reader')) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('subscriber.dashboard');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
