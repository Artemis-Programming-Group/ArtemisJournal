<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

new class extends Component {
    use WithFileUploads;

    public ?string $name = null;
    public ?string $email = null;
    public ?string $bio = null;
    public ?string $phone = null;
    public ?string $country = null;
    public ?string $city = null;
    public ?string $website = null;
    public $avatar;
    public ?string $avatar_preview = null;

    // Password fields
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio ?? null;
        $this->phone = $user->phone ?? null;
        $this->country = $user->country ?? null;
        $this->city = $user->city ?? null;
        $this->website = $user->website ?? null;
        $this->avatar_preview = $user->avatar_url ?? null;
    }

    public function updatedAvatar(): void
    {
        $this->validate([
            'avatar' => 'image|max:2048',
        ]);

        $this->avatar_preview = $this->avatar->temporaryUrl();
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'website' => $this->website,
        ];

        if ($this->avatar) {
            if ($user->avatar) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $this->avatar->store('avatars', 'public');
        }

        $user->update($data);
        $this->avatar = null;

        session()->flash('status', __('Profile updated successfully!'));
        $this->dispatch('profile-updated');
    }

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        session()->flash('password-status', 'Password updated successfully!');
    }

    public function deleteAccount(): void
    {
        $user = auth()->user();
        $user->posts()->delete();
        $user->comments()->delete();
        $user->delete();

        auth()->logout();

        $this->redirect(route('home'), true);
    }
};
?>

<div>
    <!-- Navigation -->
    <nav class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    <i class="ri-user-settings-line me-2 text-blue-600"></i>
                    {{ __('Profile Settings') }}
                </h1>
                <a wireNavigate href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    <i class="ri-arrow-left-line me-1"></i>
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-linear-to-r from-blue-600 to-indigo-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-2">
                {{ __('Manage Your Profile') }}
            </h2>
            <p class="text-blue-100">
                {{ __('Update your personal information and account settings') }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Alert Messages -->




        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <x-ui.card class="sticky top-20">
                    <div class="text-center">
                        @if($avatar_preview)
                        <img src="{{ $avatar_preview }}" alt="{{ auth()->user()->name }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-blue-600">
                        @else
                        <div class="w-24 h-24 rounded-full mx-auto mb-4 bg-linear-to-br from-blue-400 to-indigo-600 flex items-center justify-center text-white text-3xl font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        @endif

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->email }}</p>

                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 text-xs text-gray-600 dark:text-gray-400">
                            <p class="mb-2">
                                <i class="ri-file-text-line me-1 text-blue-600"></i>
                                <strong>{{ auth()->user()->posts()->count() }}</strong>
                                {{ __('Posts') }}
                            </p>
                            <p>
                                <i class="ri-chat-3-line me-1 text-purple-600"></i>
                                <strong>{{ auth()->user()->comments()->count() }}</strong>
                                {{ __('Comments') }}
                            </p>
                        </div>
                    </div>
                </x-ui.card>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Profile Information Section -->
                <x-ui.form-card title="{{ __('Profile Information') }}" description="{{ __('Update your personal details') }}">
                    <form wire:submit="updateProfile" class="space-y-6">
                        <!-- Avatar Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-3">
                                {{ __('Profile Picture') }}
                            </label>
                            <div class="flex items-center gap-6">
                                @if($avatar_preview)
                                <img src="{{ $avatar_preview }}" alt="Preview" class="w-20 h-20 rounded-lg object-cover border-2 border-gray-200 dark:border-gray-700">
                                @else
                                <div class="w-20 h-20 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <i class="ri-image-line text-2xl text-gray-400"></i>
                                </div>
                                @endif

                                <div class="flex-1">
                                    <label class="relative inline-flex items-center justify-center px-4 py-2 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer hover:border-gray-400 dark:hover:border-gray-500 transition">
                                        <span class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                            <i class="ri-upload-cloud-2-line"></i>
                                            {{ __('Upload Image') }}
                                        </span>
                                        <input type="file" wire:model.live="avatar" accept="image/*" class="hidden">
                                    </label>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">{{ __('JPG, PNG up to 2MB') }}</p>
                                </div>
                            </div>
                            @error('avatar')
                            <p class="text-red-600 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name Field -->
                        <x-ui.input
                            name="name"
                            label="{{ __('Full Name') }}"
                            placeholder="{{ __('Your name') }}"
                            wire:model="name"
                            required
                            error="{{ $errors->first('name') }}" />

                        <!-- Email Field -->
                        <x-ui.input
                            name="email"
                            type="email"
                            label="{{ __('Email Address') }}"
                            placeholder="your@email.com"
                            wire:model="email"
                            required
                            error="{{ $errors->first('email') }}" />

                        <!-- Bio Field -->
                        <x-ui.textarea
                            name="bio"
                            label="{{ __('Bio') }}"
                            placeholder="{{ __('Tell us about yourself...') }}"
                            rows="3"
                            wire:model="bio"
                            hint="{{ __('Maximum 500 characters') }}"
                            error="{{ $errors->first('bio') }}" />

                        <!-- Phone Field -->
                        <x-ui.input
                            name="phone"
                            type="tel"
                            label="{{ __('Phone Number') }}"
                            placeholder="+1 (555) 000-0000"
                            wire:model="phone"
                            error="{{ $errors->first('phone') }}" />

                        <!-- Location Fields -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-ui.input
                                name="country"
                                label="{{ __('Country') }}"
                                placeholder="{{ __('United States') }}"
                                wire:model="country"
                                error="{{ $errors->first('country') }}" />
                            <x-ui.input
                                name="city"
                                label="{{ __('City') }}"
                                placeholder="{{ __('New York') }}"
                                wire:model="city"
                                error="{{ $errors->first('city') }}" />
                        </div>

                        <!-- Website Field -->
                        <x-ui.input
                            name="website"
                            type="url"
                            label="{{ __('Website') }}"
                            placeholder="https://example.com"
                            wire:model="website"
                            error="{{ $errors->first('website') }}" />

                        <!-- Submit Button -->
                        <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <x-ui.button type="submit" variant="primary">
                                <i class="ri-save-line me-2"></i>
                                {{ __('Save Changes') }}
                            </x-ui.button>
                            <x-ui.button type="button" variant="secondary" wire:click="mount">
                                {{ __('Reset') }}
                            </x-ui.button>
                        </div>
                    </form>
                    @if (session('status'))
                    <div class="my-5">
                        <x-ui.alert type="success">
                            {{ session('status') }}
                        </x-ui.alert>
                    </div>
                    @endif
                </x-ui.form-card>

                <!-- Change Password Section -->
                <x-ui.form-card title="{{ __('Security') }}" description="{{ __('Update your password') }}">
                    <form wire:submit="updatePassword" class="space-y-6">
                        <!-- Current Password -->
                        <x-ui.input
                            name="current_password"
                            type="password"
                            label="{{ __('Current Password') }}"
                            placeholder="••••••••"
                            wire:model="current_password"
                            required
                            error="{{ $errors->first('current_password') }}" />

                        <!-- New Password -->
                        <x-ui.input
                            name="password"
                            type="password"
                            label="{{ __('New Password') }}"
                            placeholder="••••••••"
                            wire:model="password"
                            required
                            hint="{{ __('At least 8 characters') }}"
                            error="{{ $errors->first('password') }}" />

                        <!-- Confirm Password -->
                        <x-ui.input
                            name="password_confirmation"
                            type="password"
                            label="{{ __('Confirm Password') }}"
                            placeholder="••••••••"
                            wire:model="password_confirmation"
                            required
                            error="{{ $errors->first('password_confirmation') }}" />

                        <!-- Submit Button -->
                        <div class="flex gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <x-ui.button type="submit" variant="primary">
                                <i class="ri-shield-check-line me-2"></i>
                                {{ __('Update Password') }}
                            </x-ui.button>
                            <x-ui.button type="button" variant="secondary" wire:click="$reset('current_password', 'password', 'password_confirmation')">
                                {{ __('Clear') }}
                            </x-ui.button>
                        </div>
                    </form>

                    @if (session('password-status'))
                    <div class="my-5">
                        <x-ui.alert type="success" title="{{ __('Success!') }}">
                            {{ session('password-status') }}
                        </x-ui.alert>
                    </div>
                    @endif
                </x-ui.form-card>

                @if (false)
                <!-- Danger Zone -->
                <x-ui.form-card class="border-red-200 dark:border-red-900/30 bg-red-50 dark:bg-red-900/10">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-red-900 dark:text-red-200 mb-2">
                                <i class="ri-alert-line me-2"></i>Delete Account
                            </h3>
                            <p class="text-sm text-red-800 dark:text-red-300 mb-4">
                                {{ __('This action is permanent. All your data will be deleted and cannot be recovered.') }}
                            </p>
                        </div>
                        <x-ui.button
                            type="button"
                            variant="danger"
                            @click="if(confirm('Are you sure? This action cannot be undone.')) $wire.deleteAccount()">
                            <i class="ri-delete-bin-line me-2"></i>
                            {{ __('Delete Account') }}
                        </x-ui.button>
                    </div>
                </x-ui.form-card>
                @endif
            </div>
        </div>
    </div>
</div>
