<x-app-layout>
    <div class="min-h-screen bg-zinc-950 text-white">
        <div class="max-w-2xl mx-auto px-4 py-8 space-y-4">

            <h2 class="text-xl font-bold">Notifications</h2>

            @forelse ($notifications as $notification)
            <div class="bg-zinc-900 border {{ $notification->read ? 'border-zinc-800' : 'border-zinc-600' }} rounded-2xl p-4 flex items-center gap-4">

                {{-- Avatar --}}
                <div class="w-9 h-9 rounded-full bg-zinc-700 flex items-center justify-center text-sm font-bold shrink-0">
                    @if ($notification->actor->avatar)
                        <img src="{{ asset('storage/' . $notification->actor->avatar) }}" class="w-9 h-9 rounded-full object-cover" />
                    @else
                        {{ strtoupper(substr($notification->actor->name, 0, 1)) }}
                    @endif
                </div>

                {{-- Message --}}
                <div class="flex-1">
                    @if ($notification->type === 'like')
                        <p class="text-sm">
                            <a href="{{ route('profile.show', $notification->actor) }}" class="font-semibold hover:underline">{{ $notification->actor->name }}</a>
                            <span class="text-zinc-400"> liked your post</span>
                        </p>
                    @elseif ($notification->type === 'reply')
                        <p class="text-sm">
                            <a href="{{ route('profile.show', $notification->actor) }}" class="font-semibold hover:underline">{{ $notification->actor->name }}</a>
                            <span class="text-zinc-400"> replied to your post</span>
                        </p>
                    @elseif ($notification->type === 'follow')
                        <p class="text-sm">
                            <a href="{{ route('profile.show', $notification->actor) }}" class="font-semibold hover:underline">{{ $notification->actor->name }}</a>
                            <span class="text-zinc-400"> started following you</span>
                        </p>
                    @endif
                    <p class="text-xs text-zinc-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                </div>

                {{-- Unread dot --}}
                @if (!$notification->read)
                <div class="w-2 h-2 rounded-full bg-blue-400 shrink-0"></div>
                @endif

            </div>
            @empty
            <div class="text-center text-zinc-500 py-20">
                <p>No notifications yet.</p>
            </div>
            @endforelse

        </div>
    </div>
</x-app-layout>