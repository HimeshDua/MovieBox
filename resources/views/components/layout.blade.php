<!DOCTYPE html>

<html lang="en" class="bg-background text-foreground">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title ?? 'Movie Box' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen w-full bg-background text-foreground overflow-x-hidden">

    <header class="bg-sidebar text-sidebar-foreground shadow-md">
        <nav class="container mx-auto flex items-center justify-between py-4 px-6">
            {{-- Logo / Title --}}
            <a href="{{ route('movies.index') }}"
                class="text-2xl font-bold text-primary hover:text-primary/80 transition-colors">
                Movie Box
            </a>

            <ul class="flex items-center space-x-6">
                <li>
                    <a href="{{ route('movies.index') }}"
                        class="text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors px-3 py-1 rounded-md">
                        Movies
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('shows.index') }}"
                        class="text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors px-3 py-1 rounded-md">
                        Shows
                    </a>
                </li>
                @auth
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors px-3 py-1 rounded-md">
                            Dashboard
                        </a>
                    </li>
                @endauth --}}
            </ul>

            {{-- User Menu --}}
            <div class="flex items-center space-x-4">
                @auth
                    <div
                        class="w-8 h-8 bg-muted text-muted-foreground flex items-center justify-center rounded-full text-sm font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <span class="text-sm font-medium text-muted-foreground">
                        {{ Auth::user()->name }}
                    </span>


                    <form method="POST" action="{{ route('signout') }}">
                        @csrf
                        <button type="submit"
                            class="px-3 py-1 text-red-500 hover:bg-red-100 dark:hover:bg-red-900 transition-colors rounded-md text-sm font-semibold">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('signin') }}"
                        class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">
                        Sign In
                    </a>
                    <a href="{{ route('signup') }}"
                        class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">
                        Sign Up
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <div class="container mx-auto mt-6 px-4 sm:px-6">
        @if (session('status'))
            <div class="bg-green-100 text-green-800 text-sm p-3 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <main class="max-w-5xl min-h-[58vh]  mx-auto px-4 sm:px-6 py-10 space-y-12">
        {{ $slot }}
    </main>

    <footer class="mt-12 py-8 border-t border-border text-center text-sm text-muted-foreground">
        &copy; {{ date('Y') }} MovieBox. All rights reserved.
    </footer>

</body>

</html>
