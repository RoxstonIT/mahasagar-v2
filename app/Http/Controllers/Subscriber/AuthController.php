<?php

namespace App\Http\Controllers\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->check()) {
            return $this->redirectAuthenticatedUser(auth()->user());
        }

        return view('subscriber.auth.login');
    }

    public function login(Request $request)
    {
        if (auth()->check()) {
            return $this->redirectAuthenticatedUser(auth()->user());
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);
        }

        $request->session()->regenerate();

        $user = $request->user();

        if ($user->hasRole('superadmin')) {
            return redirect()->route('admin.dashboard');
        }

        if (!$user->hasRole('reader')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'This account is not registered as a subscriber.',
            ]);
        }

        if (!$user->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        return redirect()->route('subscriber.dashboard');
    }

    public function showRegisterForm()
    {
        if (auth()->check()) {
            return $this->redirectAuthenticatedUser(auth()->user());
        }

        return view('subscriber.auth.register');
    }

    public function register(Request $request)
    {
        if (auth()->check()) {
            return $this->redirectAuthenticatedUser(auth()->user());
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $readerRole = Role::where('name', 'reader')->first();

        if (!$readerRole) {
            throw ValidationException::withMessages([
                'email' => 'Subscriber registration is not available yet.',
            ]);
        }

        $user = User::create($data);
        $user->roles()->syncWithoutDetaching([$readerRole->id]);

        event(new Registered($user));

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('verification.notice');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function redirectAuthenticatedUser(User $user)
    {
        if ($user->hasRole('superadmin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('reader')) {
            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }

            return redirect()->route('subscriber.dashboard');
        }

        return redirect()->route('home');
    }
}
