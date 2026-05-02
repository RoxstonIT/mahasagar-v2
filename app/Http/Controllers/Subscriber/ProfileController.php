<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $profile = $request->user()
            ->subscriberProfile()
            ->firstOrCreate([]);

        $newsletterSubscriber = NewsletterSubscriber::where('email', Str::lower($request->user()->email))
            ->first();

        return view('subscriber.profile', compact('profile', 'newsletterSubscriber'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female,other,prefer_not_to_say'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        $user = $request->user();
        $profile = $user->subscriberProfile()->firstOrCreate([]);

        $user->update([
            'name' => $data['name'],
        ]);

        $profile->update([
            'phone' => $data['phone'] ?? null,
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'gender' => $data['gender'] ?? null,
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'bio' => $data['bio'] ?? null,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePhoto(Request $request)
    {
        $data = $request->validate([
            'profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $profile = $request->user()
            ->subscriberProfile()
            ->firstOrCreate([]);

        if ($profile->profile_photo) {
            Storage::disk('public')->delete($profile->profile_photo);
        }

        $profile->update([
            'profile_photo' => $data['profile_photo']->store('subscriber-profiles', 'public'),
        ]);

        return back()->with('success', 'Profile photo updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $request->user()->update([
            'password' => $data['password'],
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
