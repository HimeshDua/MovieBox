<!DOCTYPE html>
<html lang="en" class="bg-background text-foreground">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Movie Box</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen w-screen bg-background text-foreground overflow-x-hidden">

    <nav class="container mx-auto bg-sidebar text-sidebar-foreground py-4 px-6 rounded-b-radius shadow-md">
        <div class="flex items-center justify-end gap-6">
            <a href="/"
                class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Home</a>
            <a href="/movies"
                class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Movies</a>
            <a href="/shows"
                class="px-3 py-1 rounded-md text-sidebar-accent-foreground hover:bg-sidebar-accent hover:text-sidebar-accent-foreground transition-colors">Shows</a>
        </div>
    </nav>

    <main
        class="container flex flex-col gap-y-8 mx-auto px-4 sm:px-6 py-10 max-w-6xl bg-card text-card-foreground mt-8 p-6 rounded-[--radius] shadow-sm">
        {{ $slot }}
    </main>

</body>

</html>
