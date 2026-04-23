<x-app-layout>
    <div class="min-h-screen bg-zinc-950 text-white">
        <div class="max-w-2xl mx-auto px-4 py-8 space-y-6">

            {{-- Profile Header --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">

                        {{-- Avatar --}}
                        <div class="w-14 h-14 rounded-full bg-zinc-700 flex items-center justify-center text-xl font-bold overflow-hidden">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="w-14 h-14 object-cover" />
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>

                        <div>
                            <h2 class="text-lg font-bold">{{ $user->name }}</h2>
                            @if ($user->bio)
                                <p class="text-sm text-zinc-400 mt-0.5">{{ $user->bio }}</p>
                            @endif
                            <p class="text-xs text-zinc-500 mt-1">Joined {{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        @if ($isOwner)
                            <a href="{{ route('profile.edit') }}" class="text-xs border border-zinc-700 px-4 py-2 rounded-full hover:border-zinc-400 transition">
                                Edit profile
                            </a>
                        @else
                            <form method="POST" action="{{ route('users.follow', $user) }}">
                                @csrf
                                <button type="submit" class="text-xs px-4 py-2 rounded-full font-semibold transition
                                    {{ Auth::user()->isFollowing($user) ? 'bg-zinc-700 text-white hover:bg-red-500' : 'bg-white text-black hover:bg-zinc-200' }}">
                                    {{ Auth::user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Stats --}}
                <div class="flex gap-6 pt-2 border-t border-zinc-800">
                    <div class="text-center">
                        <p class="text-lg font-bold">{{ $posts->count() }}</p>
                        <p class="text-xs text-zinc-500">Posts</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold">{{ $user->followers->count() }}</p>
                        <p class="text-xs text-zinc-500">Followers</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold">{{ $user->follows->count() }}</p>
                        <p class="text-xs text-zinc-500">Following</p>
                    </div>
                    <div class="text-center">
                        <p class="text-lg font-bold">{{ $posts->sum('likes_count') }}</p>
                        <p class="text-xs text-zinc-500">Likes</p>
                    </div>
                </div>
            </div>

            {{-- Posts --}}
            <h3 class="text-sm font-semibold text-zinc-400 uppercase tracking-widest">Posts</h3>

            @forelse ($posts as $post)
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5 space-y-3">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-zinc-500">{{ $post->created_at->diffForHumans() }}</p>

                    @if ($isOwner)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-zinc-600 hover:text-red-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </form>
                    @endif
                </div>

                <p class="text-sm text-zinc-200 leading-relaxed">{{ $post->content }}</p>

                @if ($post->hashtags->count())
                <div class="flex flex-wrap gap-2">
                    @foreach ($post->hashtags as $tag)
                    <span class="text-xs text-blue-400">#{{ $tag->name }}</span>
                    @endforeach
                </div>
                @endif

                <div class="flex items-center gap-6 pt-2 text-xs text-zinc-500">
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        {{ $post->likes_count }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                        </svg>
                        {{ $post->replies_count }}
                    </span>
                </div>
            </div>
            @empty
            <div class="text-center text-zinc-500 py-20">
                <p>No posts yet.</p>
            </div>
            @endforelse

        </div>
    </div>
</x-app-layout>