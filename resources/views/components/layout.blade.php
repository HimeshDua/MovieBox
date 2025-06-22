<!DOCTYPE html>
<html lang="en" class="bg-background text-foreground">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title ?? 'Movie Box' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen w-screen bg-background text-foreground overflow-x-hidden">

    <main
        class="container flex flex-col gap-y-8 mx-auto px-4 sm:px-6 py-10 max-w-6xl bg-card text-card-foreground mt-8 p-6 rounded-[--radius] shadow-sm">

        <nav class="container mx-auto bg-sidebar text-sidebar-foreground py-4 px-6 rounded-b-radius shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex gap-6">
                    <a href="/"
                        class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Home</a>
                    <a href="/movies"
                        class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Movies</a>
                    <a href="/shows"
                        class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Shows</a>
                </div>

                @auth
                    <div class="flex items-center gap-4">
                        <!-- User Initials Circle -->
                        <div
                            class="w-8 h-8 bg-muted text-muted-foreground flex items-center justify-center rounded-full text-sm font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <!-- User Name -->
                        <span class="text-sm font-medium text-muted-foreground">
                            {{ Auth::user()->name }}
                        </span>

                        <!-- Signout Form -->
                        <form method="POST" action="{{ route('signout') }}">
                            @csrf
                            <button type="submit"
                                class="px-3 py-1 rounded-md text-red-500 hover:bg-red-100 dark:hover:bg-red-900 transition-colors text-sm font-semibold">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex gap-3">
                        <a href="/signin"
                            class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Sign
                            In</a>
                        <a href="/signup"
                            class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Sign
                            Up</a>
                    </div>
                @endauth
            </div>
        </nav>

        @if (session('status'))
            <div class="bg-green-100 text-green-800 text-sm p-3 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror

        <h1 class="text-4xl font-bold text-center text-primary tracking-tight">
            {{ $section_title ?? '' }}
        </h1>


        {{ $slot }}
    </main>

</body>

</html>
