<x-app-layout>
    <div class="min-h-screen bg-zinc-950 text-white">
        <div class="max-w-2xl mx-auto px-4 py-8 space-y-6">

            <h2 class="text-xl font-bold">Saved Posts</h2>

            @forelse ($saved as $item)
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5 space-y-3">

                {{-- Post Header --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-zinc-700 flex items-center justify-center text-xs font-bold overflow-hidden shrink-0">
                            @if ($item->post->user->avatar)
                                <img src="{{ asset('storage/' . $item->post->user->avatar) }}" class="w-8 h-8 object-cover" />
                            @else
                                {{ strtoupper(substr($item->post->user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('profile.show', $item->post->user) }}" class="text-sm font-semibold hover:underline">
                                {{ $item->post->user->name }}
                            </a>
                            <p class="text-xs text-zinc-500">{{ $item->post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <p class="text-sm text-zinc-200 leading-relaxed">{{ $item->post->content }}</p>

                {{-- Hashtags --}}
                @if ($item->post->hashtags->count())
                <div class="flex flex-wrap gap-2">
                    @foreach ($item->post->hashtags as $tag)
                    <span class="text-xs text-blue-400">#{{ $tag->name }}</span>
                    @endforeach
                </div>
                @endif

                {{-- Actions --}}
                <div class="flex items-center gap-6 pt-2">

                    {{-- Like --}}
                    <form method="POST" action="{{ route('posts.like', $item->post) }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-1 transition text-xs
                            {{ $item->post->likes()->where('user_id', Auth::id())->exists() ? 'text-red-400' : 'text-zinc-500 hover:text-red-400' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="{{ $item->post->likes()->where('user_id', Auth::id())->exists() ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            {{ $item->post->likes_count }}
                        </button>
                    </form>

                    {{-- Reply toggle --}}
                    <button onclick="document.getElementById('reply-saved-{{ $item->post->id }}').classList.toggle('hidden')"
                        class="flex items-center gap-1 text-zinc-500 hover:text-blue-400 transition text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                        </svg>
                        {{ $item->post->replies_count }}
                    </button>

                    {{-- Unsave --}}
                    <form method="POST" action="{{ route('posts.save', $item->post) }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-1 text-yellow-400 hover:text-zinc-500 transition text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0z" />
                            </svg>
                            Unsave
                        </button>
                    </form>

                </div>

                {{-- Reply Box --}}
                <div id="reply-saved-{{ $item->post->id }}" class="hidden pt-3 border-t border-zinc-800">

                    {{-- Existing replies --}}
                    @foreach ($item->post->replies()->with('user')->latest()->get() as $reply)
                    <div class="flex items-start gap-3 py-2">
                        <div class="w-6 h-6 rounded-full bg-zinc-700 flex items-center justify-center text-xs font-bold shrink-0 overflow-hidden">
                            @if ($reply->user->avatar)
                                <img src="{{ asset('storage/' . $reply->user->avatar) }}" class="w-6 h-6 object-cover" />
                            @else
                                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="flex-1">
                            <a href="{{ route('profile.show', $reply->user) }}" class="text-xs font-semibold hover:underline">{{ $reply->user->name }}</a>
                            <span class="text-xs text-zinc-400 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                            <p class="text-xs text-zinc-300 mt-1">{{ $reply->content }}</p>
                        </div>
                        @if ($reply->user_id === Auth::id())
                        <form method="POST" action="{{ route('replies.destroy', $reply) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-zinc-600 hover:text-red-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                        @endif
                    </div>
                    @endforeach

                    {{-- Reply form --}}
                    <form method="POST" action="{{ route('replies.store', $item->post) }}" class="flex gap-2 mt-2">
                        @csrf
                        <input
                            type="text"
                            name="content"
                            maxlength="280"
                            placeholder="Write a reply..."
                            class="flex-1 bg-zinc-800 border border-zinc-700 rounded-xl px-3 py-2 text-xs text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition"
                        />
                        <button type="submit" class="bg-white text-black px-3 py-2 rounded-xl text-xs font-semibold hover:bg-zinc-200 transition">
                            Reply
                        </button>
                    </form>
                </div>

            </div>
            @empty
            <div class="text-center text-zinc-500 py-20">
                <p>No saved posts yet.</p>
            </div>
            @endforelse

        </div>
    </div>
</x-app-layout>