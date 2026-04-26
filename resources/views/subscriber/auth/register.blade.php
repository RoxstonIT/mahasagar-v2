@extends('layouts.web.app')

@section('title', 'Subscriber Registration')

@section('content')
<section class="py-16">
    <div class="max-w-md mx-auto px-4">
        <div class="border-t-4 border-[#ec1e20] bg-white p-8 shadow-sm">
            <h1 class="text-3xl font-bold tracking-tight mb-2">Create Account</h1>
            <p class="text-sm text-neutral-600 mb-8">
                Register as a Mahasagar reader to access subscriber features.
            </p>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 text-red-700 p-4 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('subscriber.register.submit') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                           required
                           autofocus>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password"
                           name="password"
                           class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                           required>
                </div>

                <button type="submit" class="w-full bg-[#ec1e20] text-white px-4 py-2 font-semibold hover:opacity-90">
                    Register
                </button>
            </form>

            <p class="text-sm text-neutral-600 mt-6">
                Already registered?
                <a href="{{ route('subscriber.login') }}" class="text-[#ec1e20] font-semibold hover:underline">
                    Login
                </a>
            </p>
        </div>
    </div>
</section>
@endsection
