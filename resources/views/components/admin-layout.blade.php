<!DOCTYPE html>
<html lang="en" class="bg-background text-foreground">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Admin Panel' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-background text-foreground overflow-x-hidden">

    <header class="bg-card border-b border-border shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}"
                class="text-xl font-bold text-primary hover:text-primary/80 transition-colors">
                Admin Panel
            </a>

            <ul class="flex items-center space-x-6">
                <li> <a href="{{ route('admin.movies.index') }}" class="btn btn-link">Movies</a></li>
                <li> <a href="{{ route('admin.shows.index') }}" class="btn btn-link"> Shows</a></li>
                <li> <a href="{{ route('admin.users.index') }}" class="btn btn-link"> Customers </a></li>
            </ul>

            <div class="flex items-center space-x-2">
                @auth
                    <a href="{{ route('profile.index') }}">
                        <span class="btn btn-outline">
                            {{ Auth::user()->name }}
                        </span>
                    </a>

                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-destructive">
                            Logout
                        </button>
                    </form>
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
