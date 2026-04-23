<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-2xl font-bold text-center mb-6">
            Admin Login
        </h2>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]">
            </div>

            {{-- Password --}}
            <div>
                <label class="block mb-1 text-sm font-medium">Password</label>
                <input type="password" name="password"
                    required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#ec1e20]">
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Button --}}
            <button type="submit"
                class="w-full bg-[#ec1e20] text-white py-2 rounded-lg hover:opacity-90 transition">
                Login
            </button>

        </form>

    </div>

</body>
</html>