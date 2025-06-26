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
                <li>
                    <a href="{{ route('admin.movies.index') }}"
                        class="text-muted-foreground hover:text-primary transition-colors text-sm font-medium">
                        Movies
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.shows.index') }}"
                        class="text-muted-foreground hover:text-primary transition-colors text-sm font-medium">
                        Shows
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="text-muted-foreground hover:text-primary transition-colors text-sm font-medium">
                        Users
                    </a>
                </li>
            </ul>

            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-muted-foreground font-medium">
                        {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1 text-red-500 hover:bg-red-100 dark:hover:bg-red-900 transition-colors text-sm font-semibold rounded-md">
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
