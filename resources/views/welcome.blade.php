<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazz — Say it in text</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 text-white font-sans">

    {{-- Navbar --}}
    <nav class="flex items-center justify-between px-8 py-5 border-b border-zinc-800">
        <h1 class="text-2xl font-bold tracking-tight text-white">Hazz</h1>
        <div class="flex gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-zinc-400 hover:text-white transition">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-zinc-400 hover:text-white transition">Log in</a>
                <a href="{{ route('register') }}" class="text-sm bg-white text-black px-4 py-2 rounded-full font-medium hover:bg-zinc-200 transition">Sign up</a>
            @endauth
        </div>
    </nav>

    {{-- Hero --}}
    <section class="flex flex-col items-center justify-center text-center px-6 py-32">
        <h2 class="text-6xl font-extrabold leading-tight tracking-tight max-w-3xl">
            Just words.<br><span class="text-zinc-400">Nothing else.</span>
        </h2>
        <p class="mt-6 text-zinc-400 text-lg max-w-xl">
            Hazz is a text-only space to share your thoughts, ideas, and stories. No images. No videos. Just pure expression.
        </p>
        <div class="mt-10 flex gap-4">
            <a href="{{ route('register') }}" class="bg-white text-black px-6 py-3 rounded-full font-semibold hover:bg-zinc-200 transition">Get started</a>
            <a href="{{ route('login') }}" class="border border-zinc-700 text-white px-6 py-3 rounded-full font-semibold hover:border-zinc-400 transition">Log in</a>
        </div>
    </section>

    {{-- Features --}}
    <section class="px-8 py-20 max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-zinc-900 rounded-2xl p-6 border border-zinc-800">
            <div class="w-8 h-8 mb-4 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.625 2.625 0 1 1 3.71 3.71L7.5 21.27l-4.5 1.5 1.5-4.5L16.862 4.487z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-2">Post freely</h3>
            <p class="text-zinc-400 text-sm">Share your thoughts without the noise of media. Text is all you need.</p>
        </div>
        <div class="bg-zinc-900 rounded-2xl p-6 border border-zinc-800">
            <div class="w-8 h-8 mb-4 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.468 5.99 5.99 0 0 0-1.925 3.547 5.975 5.975 0 0 1-2.133-1.001A3.75 3.75 0 0 0 12 18z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-2">Trending hashtags</h3>
            <p class="text-zinc-400 text-sm">Discover what people are talking about through live trending tags.</p>
        </div>
        <div class="bg-zinc-900 rounded-2xl p-6 border border-zinc-800">
            <div class="w-8 h-8 mb-4 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold mb-2">Save & revisit</h3>
            <p class="text-zinc-400 text-sm">Bookmark posts you love and come back to them anytime.</p>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="text-center text-zinc-600 text-sm py-8 border-t border-zinc-800">
        © {{ date('Y') }} Hazz. Built with words.
    </footer>

</body>
</html>