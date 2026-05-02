<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterVerificationMail;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->merge([
            'newsletter_email' => Str::lower(trim((string) $request->input('newsletter_email'))),
        ]);

        $data = $request->validate([
            'newsletter_email' => ['required', 'email', 'max:255'],
        ], [
            'newsletter_email.required' => 'Please enter your email address.',
            'newsletter_email.email' => 'Please enter a valid email address.',
            'newsletter_email.max' => 'Please enter an email address under 255 characters.',
        ]);

        $email = $data['newsletter_email'];

        $registeredUserExists = User::whereRaw('LOWER(email) = ?', [$email])->exists();

        if ($registeredUserExists) {
            return back()->with('newsletter_error', 'This email belongs to a registered account. Please manage newsletter subscription from your profile dashboard.');
        }

        $existingSubscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($existingSubscriber && $existingSubscriber->verified_at) {
            return back()->with('newsletter_status', 'This email ID is already subscribed.');
        }

        if ($existingSubscriber) {
            return back()->with('newsletter_status', 'Subscription confirmation already sent to this email ID.');
        }

        $plainToken = Str::random(64);

        $subscriber = NewsletterSubscriber::create([
            'email' => $email,
            'verification_token' => hash('sha256', $plainToken),
            'source' => 'footer',
        ]);

        try {
            Mail::to($subscriber->email)->send(
                new NewsletterVerificationMail(route('newsletter.verify', $plainToken))
            );
        } catch (\Throwable $exception) {
            $subscriber->delete();
            report($exception);

            return back()->with('newsletter_error', 'We could not send the confirmation email right now. Please try again later.');
        }

        return back()->with('newsletter_success', 'Subscription confirmation sent. Please check your email.');
    }

    public function verify($token)
    {
        $subscriber = NewsletterSubscriber::where('verification_token', hash('sha256', $token))
            ->first();

        if (!$subscriber) {
            return redirect()
                ->route('home')
                ->with('newsletter_error', 'Invalid or expired newsletter verification link.');
        }

        $subscriber->update([
            'verified_at' => now(),
            'verification_token' => null,
        ]);

        return redirect()
            ->route('home')
            ->with('newsletter_success', 'Newsletter subscription verified successfully.');
    }
}
