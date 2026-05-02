<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function toggle(Request $request)
    {
        $user = $request->user();
        $email = Str::lower($user->email);

        $subscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($subscriber && $subscriber->verified_at) {
            $subscriber->delete();

            return back()->with('success', 'You have unsubscribed from the newsletter.');
        }

        NewsletterSubscriber::updateOrCreate(
            ['email' => $email],
            [
                'user_id' => $user->id,
                'verification_token' => null,
                'verified_at' => now(),
                'source' => 'subscriber_profile',
            ]
        );

        return back()->with('success', 'You are now subscribed to the newsletter.');
    }
}
