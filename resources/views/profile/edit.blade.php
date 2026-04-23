<x-app-layout>
    <div class="min-h-screen bg-zinc-950 text-white">
        <div class="max-w-2xl mx-auto px-4 py-8 space-y-6">

            <h2 class="text-xl font-bold">Edit Profile</h2>

            {{-- Profile Info --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>