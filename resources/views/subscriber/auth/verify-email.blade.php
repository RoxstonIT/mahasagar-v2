@extends('layouts.web.app')

@section('title', 'Verify Email')

@section('content')
<section class="py-16">
    <div class="max-w-2xl mx-auto px-4">
        <div class="border-t-4 border-[#ec1e20] bg-white p-8 shadow-sm">
            <h1 class="text-3xl font-bold tracking-tight mb-4">Verify Your Email</h1>

            <p class="text-neutral-700 leading-relaxed">
                We have sent a verification link to your email address. Please verify your email before opening your subscriber dashboard.
            </p>

            @if (session('status') === 'verification-link-sent')
                <div class="mt-6 bg-green-50 text-green-700 p-4 text-sm">
                    A fresh verification link has been sent to your email address.
                </div>
            @endif

            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="bg-[#ec1e20] text-white px-5 py-2 font-semibold hover:opacity-90">
                        Resend Verification Email
                    </button>
                </form>

                <form method="POST" action="{{ route('subscriber.logout') }}">
                    @csrf
                    <button type="submit" class="px-5 py-2 border border-neutral-300 font-semibold hover:border-[#ec1e20] hover:text-[#ec1e20]">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
