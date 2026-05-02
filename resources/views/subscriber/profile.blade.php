@extends('subscriber.layout')

@section('title', 'Profile')

@section('content')
<div class="space-y-8">
    <div class="border-t-4 border-[#ec1e20] bg-white p-8 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-widest text-[#ec1e20] mb-3">
            Subscriber Profile
        </p>

        <h1 class="text-3xl font-bold tracking-tight mb-4">
            Profile
        </h1>

        <p class="text-neutral-700 leading-relaxed">
            Manage your basic reader profile and account security.
        </p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 text-red-700 p-4 text-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-neutral-200 p-6">
        <h2 class="text-2xl font-bold tracking-tight mb-4">Email Status</h2>

        <p class="text-sm text-neutral-700">
            {{ auth()->user()->email }}
        </p>

        @if(auth()->user()->hasVerifiedEmail())
            <p class="mt-3 text-sm font-semibold text-green-700">
                Email verified
            </p>
        @else
            <p class="mt-3 text-sm font-semibold text-[#ec1e20]">
                Email not verified
            </p>

            <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
                @csrf
                <button type="submit" class="bg-[#ec1e20] text-white px-4 py-2 text-sm font-semibold hover:opacity-90">
                    Resend Verification Email
                </button>
            </form>
        @endif
    </div>

    <div class="bg-white border border-neutral-200 p-6">
        <h2 class="text-2xl font-bold tracking-tight mb-4">Newsletter</h2>

        @if(auth()->user()->hasVerifiedEmail())
            @php $isNewsletterSubscribed = $newsletterSubscriber?->verified_at !== null; @endphp

            <p class="text-sm text-neutral-700 mb-4">
                {{ $isNewsletterSubscribed ? 'You are subscribed to the Mahasagar newsletter.' : 'Subscribe to receive curated Mahasagar updates at your verified account email.' }}
            </p>

            <form method="POST" action="{{ route('subscriber.newsletter.toggle') }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 text-sm font-semibold {{ $isNewsletterSubscribed ? 'border border-neutral-300 text-neutral-800 hover:border-[#ec1e20] hover:text-[#ec1e20]' : 'bg-[#ec1e20] text-white hover:opacity-90' }}">
                    {{ $isNewsletterSubscribed ? 'Unsubscribe from Newsletter' : 'Subscribe to Newsletter' }}
                </button>
            </form>
        @else
            <p class="text-sm text-neutral-600">
                Verify your account email to manage newsletter subscription from your profile.
            </p>
        @endif
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-[260px_1fr] gap-8">
        <div class="bg-white border border-neutral-200 p-6 h-fit">
            <h2 class="text-2xl font-bold tracking-tight mb-5">Profile Photo</h2>

            <div class="mb-5">
                @if($profile->profile_photo)
                    <img src="{{ asset('storage/' . $profile->profile_photo) }}"
                         alt="{{ auth()->user()->name }}"
                         class="w-32 h-32 object-cover rounded-full border border-neutral-200">
                @else
                    <div class="w-32 h-32 rounded-full bg-neutral-100 border border-neutral-200 flex items-center justify-center text-4xl font-bold text-[#ec1e20]">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            @if(auth()->user()->hasVerifiedEmail())
                <form method="POST" action="{{ route('subscriber.profile.photo.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <input type="file"
                           name="profile_photo"
                           class="w-full border border-neutral-300 px-3 py-2 text-sm"
                           accept="image/jpeg,image/png,image/webp"
                           required>

                    <button type="submit" class="bg-[#ec1e20] text-white px-4 py-2 text-sm font-semibold hover:opacity-90">
                        Upload Photo
                    </button>
                </form>
            @else
                <p class="text-sm text-neutral-600">
                    Verify your email to update your profile photo.
                </p>
            @endif
        </div>

        <div class="space-y-8">
            <div class="bg-white border border-neutral-200 p-6">
                <h2 class="text-2xl font-bold tracking-tight mb-5">Basic Details</h2>

                <form method="POST" action="{{ route('subscriber.profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium mb-1">Full Name</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                               {{ auth()->user()->hasVerifiedEmail() ? '' : 'disabled' }}
                               required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium mb-1">Phone Number</label>
                            <input type="text"
                                   name="phone"
                                   value="{{ old('phone', $profile->phone) }}"
                                   class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                   {{ auth()->user()->hasVerifiedEmail() ? '' : 'disabled' }}>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Date of Birth</label>
                            <input type="date"
                                   name="date_of_birth"
                                   value="{{ old('date_of_birth', $profile->date_of_birth?->format('Y-m-d')) }}"
                                   class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                   {{ auth()->user()->hasVerifiedEmail() ? '' : 'disabled' }}>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-medium mb-1">Gender</label>
                            <select name="gender"
                                    class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                    {{ auth()->user()->hasVerifiedEmail() ? '' : 'disabled' }}>
                                <option value="">Select</option>
                                <option value="male" {{ old('gender', $profile->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $profile->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $profile->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                <option value="prefer_not_to_say" {{ old('gender', $profile->gender) === 'prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">City</label>
                            <input type="text"
                                   name="city"
                                   value="{{ old('city', $profile->city) }}"
                                   class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                   {{ auth()->user()->hasVerifiedEmail() ? '' : 'disabled' }}>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">State</label>
                            <input type="text"
                                   name="state"
                                   value="{{ old('state', $profile->state) }}"
                                   class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                   {{ auth()->user()->hasVerifiedEmail() ? '' : 'disabled' }}>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Short Bio</label>
                        <textarea name="bio"
                                  rows="4"
                                  class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                  {{ auth()->user()->hasVerifiedEmail() ? '' : 'disabled' }}>{{ old('bio', $profile->bio) }}</textarea>
                    </div>

                    @if(auth()->user()->hasVerifiedEmail())
                        <button type="submit" class="bg-[#ec1e20] text-white px-5 py-2 font-semibold hover:opacity-90">
                            Save Details
                        </button>
                    @else
                        <p class="text-sm text-neutral-600">
                            Verify your email to edit profile details.
                        </p>
                    @endif
                </form>
            </div>

            <div class="bg-white border border-neutral-200 p-6">
                <h2 class="text-2xl font-bold tracking-tight mb-5">Change Password</h2>

                @if(auth()->user()->hasVerifiedEmail())
                    <form method="POST" action="{{ route('subscriber.profile.password.update') }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium mb-1">Current Password</label>
                            <input type="password"
                                   name="current_password"
                                   class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                   required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium mb-1">New Password</label>
                                <input type="password"
                                       name="password"
                                       class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                       required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1">Confirm New Password</label>
                                <input type="password"
                                       name="password_confirmation"
                                       class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                                       required>
                            </div>
                        </div>

                        <button type="submit" class="bg-[#ec1e20] text-white px-5 py-2 font-semibold hover:opacity-90">
                            Update Password
                        </button>
                    </form>
                @else
                    <p class="text-sm text-neutral-600">
                        Verify your email to change your password.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
