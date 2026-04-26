@extends('layouts.web.app')

@section('title', 'Subscriber Login')

@section('content')
<section class="py-16">
    <div class="max-w-md mx-auto px-4">
        <div class="border-t-4 border-[#ec1e20] bg-white p-8 shadow-sm">
            <h1 class="text-3xl font-bold tracking-tight mb-2">Subscriber Login</h1>
            <p class="text-sm text-neutral-600 mb-8">
                Sign in to continue reading and manage your Mahasagar account.
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

            <form method="POST" action="{{ route('subscriber.login.submit') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                           required
                           autofocus>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password"
                           name="password"
                           class="w-full border border-neutral-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]"
                           required>
                </div>

                <label class="flex items-center gap-2 text-sm text-neutral-600">
                    <input type="checkbox" name="remember" value="1" class="border-neutral-300 text-[#ec1e20]">
                    Remember me
                </label>

                <button type="submit" class="w-full bg-[#ec1e20] text-white px-4 py-2 font-semibold hover:opacity-90">
                    Login
                </button>
            </form>

            <p class="text-sm text-neutral-600 mt-6">
                New to Mahasagar?
                <a href="{{ route('subscriber.register') }}" class="text-[#ec1e20] font-semibold hover:underline">
                    Create an account
                </a>
            </p>
        </div>
    </div>
</section>
@endsection
