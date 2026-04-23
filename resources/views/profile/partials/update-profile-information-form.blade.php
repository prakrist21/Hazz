<section>
    <header>
        <h2 class="text-lg font-semibold text-white">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-zinc-400">
            {{ __("Update your profile details and avatar.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <!-- Bio -->
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea
                id="bio"
                name="bio"
                rows="3"
                maxlength="160"
                class="mt-1 block w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition resize-none"
                placeholder="Tell people about yourself..."
            >{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <!-- Avatar -->
        <div>
            <x-input-label for="avatar" :value="__('Profile Picture')" />
            <div class="mt-2 flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-zinc-700 flex items-center justify-center text-xl font-bold overflow-hidden">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-14 h-14 object-cover" />
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                <input
                    type="file"
                    id="avatar"
                    name="avatar"
                    accept="image/*"
                    class="text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-700 file:text-white hover:file:bg-zinc-600 transition"
                />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
        <div class="flex items-center gap-4">
            <button type="submit" class="bg-white text-black px-6 py-2 rounded-full text-sm font-semibold hover:bg-zinc-200 transition">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-400">Saved!</p>
            @endif
        </div>
    </form>
</section>
