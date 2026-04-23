<nav class="bg-zinc-950 border-b border-zinc-800 sticky top-0 z-50">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="text-xl font-extrabold tracking-tight text-white" style="font-family: 'Syne', sans-serif;">
            Hazz
        </a>

        {{-- Center links --}}
        <div class="hidden md:flex items-center gap-6">
            <a href="{{ route('dashboard') }}"
                class="text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-zinc-500 hover:text-white' }} transition">
                Feed
            </a>
            <a href="{{ route('saved.index') }}"
                class="text-sm {{ request()->routeIs('saved.index') ? 'text-white' : 'text-zinc-500 hover:text-white' }} transition">
                Saved
            </a>
            <a href="{{ route('notifications.index') }}" class="relative text-sm {{ request()->routeIs('notifications.index') ? 'text-white' : 'text-zinc-500 hover:text-white' }} transition">
                Notifications
                @if (Auth::user()->unreadNotificationsCount() > 0)
                    <span class="absolute -top-1 -right-3 bg-blue-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">
                        {{ Auth::user()->unreadNotificationsCount() }}
                    </span>
                @endif
            </a>
            <a href="{{ route('profile.show', Auth::user()) }}"
                class="text-sm {{ request()->routeIs('profile.show') ? 'text-white' : 'text-zinc-500 hover:text-white' }} transition">
                Profile
            </a>
        </div>

        {{-- Right side --}}
        <div class="flex items-center gap-4">
            <span class="text-sm text-zinc-500 hidden md:block">{{ Auth::user()->name }}</span>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm border border-zinc-700 px-4 py-1.5 rounded-full text-zinc-400 hover:text-white hover:border-zinc-400 transition">
                    Log out
                </button>
            </form>
        </div>

    </div>

    {{-- Mobile menu --}}
    <div class="md:hidden border-t border-zinc-800 px-4 py-2 flex gap-6">
        <a href="{{ route('dashboard') }}" class="text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-zinc-500' }} transition">Feed</a>
        <a href="{{ route('saved.index') }}" class="text-sm {{ request()->routeIs('saved.index') ? 'text-white' : 'text-zinc-500' }} transition">Saved</a>
        <a href="{{ route('notifications.index') }}" class="text-sm {{ request()->routeIs('notifications.index') ? 'text-white' : 'text-zinc-500' }} transition">Notifications</a>
        <a href="{{ route('profile.show', Auth::user()) }}" class="text-sm {{ request()->routeIs('profile.show') ? 'text-white' : 'text-zinc-500' }} transition">Profile</a>
    </div>
</nav>