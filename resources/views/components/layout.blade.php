<!DOCTYPE html>

<html lang="en" class="bg-background text-foreground">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title ?? 'Movie Box' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-background text-foreground overflow-x-hidden">

    <header class="bg-card border-b border-border shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}"
                class="text-xl font-bold text-primary hover:text-primary/80 transition-colors">
                Movie Box
            </a>

            <ul class="flex items-center space-x-6">
                <li>
                    <a href="{{ route('movies.index') }}" class="btn btn-link">
                        Movies
                    </a>
                </li>
                <li>
                    <a href="{{ route('shows.index') }}" class="btn btn-link">
                        Shows
                    </a>
                </li>
            </ul>

            <div class="flex items-center gap-2">
                @auth

                    <span class="btn btn-outline">
                        {{ Auth::user()->name }}
                    </span>
                    {{-- <div class="btn btn-outline rounded-full!">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div> --}}

                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-destructive">
                                Logout
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">Log
                        In</a>
                    <a href="{{ route('register') }}"
                        class="text-sm text-muted-foreground hover:text-foreground transition-colors">Register</a>
                @endauth
            </div>
        </nav>
    </header>


    @if (session('success'))
        <div class="max-w-5xl mx-auto px-4 sm:px-6 mt-6">
            <div class="bg-green-100 text-green-800 text-sm p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (isset($section_title))
        <div class="max-w-5xl mx-auto px-4 sm:px-6 mt-10">
            <h1 class="text-3xl font-bold text-primary tracking-tight">
                {{ $section_title }}
            </h1>
        </div>
    @endif

    <main class="max-w-5xl min-h-[60vh] mx-auto px-4 sm:px-6 py-10 space-y-12">
        {{ $slot }}
    </main>

    <footer class="mt-12 py-6 border-t border-border text-center text-sm text-muted-foreground">
        &copy; {{ date('Y') }} Movie Box. All rights reserved.
    </footer>

</body>

</html>
