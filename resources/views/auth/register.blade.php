<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hazz — Create account</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, .brand { font-family: 'Syne', sans-serif; }
        .noise {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
        }
        .glow { box-shadow: 0 0 80px rgba(255,255,255,0.03); }
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #18181b inset !important;
            -webkit-text-fill-color: #fff !important;
        }
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s forwards;
        }
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center px-4 py-10">
    <div class="noise"></div>

    <div class="w-full max-w-md relative z-10">

        {{-- Brand --}}
        <div class="fade-up mb-10 text-center" style="animation-delay: 0s">
            <a href="/" class="brand text-4xl font-extrabold tracking-tight text-white">Hazz</a>
            <p class="text-zinc-500 text-sm mt-2">Join the conversation. Text only.</p>
        </div>

        {{-- Card --}}
        <div class="fade-up glow bg-zinc-900 border border-zinc-800 rounded-3xl p-8 space-y-5" style="animation-delay: 0.1s">

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div class="space-y-1">
                    <label class="text-xs text-zinc-400 uppercase tracking-widest">Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required autofocus
                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition"
                        placeholder="Your name"
                    />
                    @error('name')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="space-y-1">
                    <label class="text-xs text-zinc-400 uppercase tracking-widest">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition"
                        placeholder="you@example.com"
                    />
                    @error('email')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-1">
                    <label class="text-xs text-zinc-400 uppercase tracking-widest">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition"
                        placeholder="••••••••"
                    />
                    @error('password')
                        <p class="text-red-400 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="space-y-1">
                    <label class="text-xs text-zinc-400 uppercase tracking-widest">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-600 focus:outline-none focus:border-zinc-500 transition"
                        placeholder="••••••••"
                    />
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-full bg-white text-black font-semibold py-3 rounded-xl hover:bg-zinc-200 transition text-sm tracking-wide">
                    Create account
                </button>
            </form>
        </div>

        {{-- Login link --}}
        <div class="fade-up text-center mt-6" style="animation-delay: 0.2s">
            <p class="text-zinc-500 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-white hover:underline ml-1">Log in</a>
            </p>
        </div>

    </div>
</body>
</html>