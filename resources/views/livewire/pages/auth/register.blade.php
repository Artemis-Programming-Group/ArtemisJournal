<?php

use App\Models\User;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

new class extends Component {

    public string $name;
    public string $email;
    public bool $terms;
    public string $password;
    public string $passwordConfirmation;


    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'same:password'],
            'terms' => ['required', 'accepted'],
        ];
    }
    public function store()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}; ?>

<div>
    <div class="min-h-screen flex items-center justify-center bg-linear-to-br from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-4 mb-3" wire:navigate>
                    <!-- <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Blog') }}</span> -->
                    <div class="w-10 h-10 bg-linear-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="ri-code-line text-white text-lg"></i>
                    </div>
                    <span>
                        <x-site-name class="text-4xl"/>
                    </span>
                </a>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ __('Create Account') }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ __('Join our community of writers and readers') }}</p>
            </div>

            <!-- Alert Messages -->
            @if ($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex gap-3 mb-2">
                    <i class="ri-error-warning-line text-red-600 dark:text-red-400 text-xl shrink-0"></i>
                    <h3 class="font-semibold text-red-800 dark:text-red-200">{{ __('Registration Failed') }}</h3>
                </div>
                <ul class="ms-6 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-700 dark:text-red-300">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Registration Form -->
            <form class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">

                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <x-ui.input label="{{ __('Full Name') }}" placeholder="Alireza" name="name" error="{{ $errors->first('name') }}" wire:model="name" />
                </div>
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <x-ui.input label="{{ __('Your Email') }}" placeholder="example@example.com" name="email" error="{{ $errors->first('email') }}" wire:model="email" />
                </div>
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <x-ui.input label="{{ __('Password') }}" type="password" placeholder="*****" name="password" error="{{ $errors->first('password') }}" wire:model="password" />
                </div>
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <x-ui.input type="password" label="{{ __('Confirm your Password') }}" placeholder="******" name="passwordConfirmation" error="{{ $errors->first('passwordConfirmation') }}" wire:model="passwordConfirmation" />
                </div>

                <!-- Terms Checkbox -->
                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 ">
                    <label class="flex items-start gap-1 cursor-pointer">
                        <x-ui.checkbox label="{{ __('I agree to the') }}" name="terms" wire:model="terms" value="true" />

                        <a href="#" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 " wire:navigate>{{ __('terms and conditions') }}</a>
                    </label>
                    @error('terms')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="p-6">
                    <button
                        wire:click="store"
                        type="button"
                        class="w-full bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                        <i class="ri-user-add-line"></i>
                        {{ __('Create Account') }}
                    </button>
                </div>

                <!-- Sign In Link -->
                <div class="px-6 pb-6 text-center">
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('Already have an account?') }}
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-semibold transition" wire:navigate>
                            {{ __('Sign in') }}
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
