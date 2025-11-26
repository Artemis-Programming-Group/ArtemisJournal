<?php

use App\Models\User;
use Livewire\Volt\Component;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

new class extends Component {

    public string $email = '';
    public string $password = '';
    public bool $remember = false;


    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function login()
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        session()->regenerate();

        $this->redirect(route('dashboard' , true));
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div>
    <div class="min-h-screen flex items-center justify-center bg-linear-to-br from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <a wireNavigate href="{{ route('home') }}" class="flex flex-col items-center gap-4 mb-3">
                    <!-- <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Blog') }}</span> -->
                    <div class="w-10 h-10 bg-linear-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="ri-code-line text-white text-lg"></i>
                    </div>
                    <span>
                        <x-site-name class="text-4xl" />
                    </span>
                </a>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Welcome Back') }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ __('Sign in to your account to continue') }}</p>
            </div>

            <!-- Alert Messages -->
            @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex gap-3 mb-2">
                    <i class="ri-error-warning-line text-red-600 dark:text-red-400 text-xl shrink-0"></i>
                    <h3 class="font-semibold text-red-800 dark:text-red-200">{{ __('Login Failed') }}</h3>
                </div>
                <ul class="ms-6 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-700 dark:text-red-300">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Login Form -->
            <form class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700" wire:submit.prevent="login">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <x-ui.input label="{{ __('Your Email') }}" placeholder="example@example.com" name="email" error="{{ $errors->first('email') }}" wire:model="email" />
                </div>
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <x-ui.input label="{{ __('Password') }}" type="password" placeholder="*****" name="password" error="{{ $errors->first('password') }}" wire:model="password" />
                </div>

                <!-- Remember Me -->
                <div class="px-4 pt-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" wire:model="remember" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="p-6">
                    <button
                        type="submit"
                        class="w-full bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                        <i class="ri-login-box-line"></i>
                        {{ __('Sign In') }}
                    </button>
                </div>

                <!-- Sign Up Link -->
                <div class="px-6 pb-6 text-center">
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('Don\'t have an account?') }}
                        <a wireNavigate href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-semibold transition" >
                            {{ __('Sign Up') }}
                        </a>
                    </p>
                </div>
            </form>

            <!-- Footer Info -->
            <div class="mt-8 text-center">
                <div class="inline-flex items-center gap-4 text-xs text-gray-600 dark:text-gray-400">
                    <span class="flex items-center gap-1">
                        <i class="ri-shield-check-line text-green-500"></i>
                        {{ __('Secure') }}
                    </span>
                    <span>•</span>
                    <span class="flex items-center gap-1">
                        <i class="ri-lock-line text-green-500"></i>
                        {{ __('Encrypted') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
