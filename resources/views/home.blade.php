<x-layout>
    {{-- <main class="space-y-16 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto"> --}}

    <x-slot:title>
        Discover - Movie Box
    </x-slot>


    <section class="text-center py-16 sm:py-24 bg-card rounded-2xl shadow-lg">
        <h1 class="text-4xl sm:text-5xl font-bold text-primary mb-4">Welcome to MovieBox</h1>
        <p class="text-muted-foreground max-w-2xl mx-auto text-lg">
            Book tickets for the latest blockbusters and upcoming films. Seamless booking. Instant access.
        </p>
        <div class="mt-6 flex justify-center gap-4">
            <a href="{{ route('movies.index') }}"
                class="px-6 py-2 bg-primary text-primary-sforeground rounded-md hover:opacity-90 transition">Browse
                Movies</a>
            <a href="#coming-soon" class="px-6 py-2 border border-border rounded-md hover:bg-muted transition">Coming
                Soon</a>
        </div>
    </section>

    <section>
        <h2 class="text-3xl font-semibold mb-6 text-primary">Now Showing</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($nowShowing as $movie)
                <div
                    class="bg-card text-card-foreground border border-border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-64 object-cover">
                    <div class="p-4 space-y-2">
                        <h3 class="text-xl font-semibold">{{ $movie->title }}</h3>
                        <p class="text-sm text-muted-foreground line-clamp-2">{{ $movie->description }}</p>
                        <div class="text-sm text-yellow-500">⭐ {{ $movie->rating }}/10</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="coming-soon">
        <h2 class="text-3xl font-semibold mb-6 text-primary">Coming Soon</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($comingSoon as $movie)
                <div class="bg-muted text-foreground border border-border rounded-xl overflow-hidden shadow-sm">
                    <div class="relative">
                        <img src="{{ $movie->poster }}" alt="{{ $movie->title }}"
                            class="w-full h-64 object-cover grayscale opacity-70">
                        <div
                            class="absolute inset-0 flex items-center justify-center text-xl font-bold text-muted-foreground bg-black/40">
                            Coming Soon</div>
                    </div>
                    <div class="p-4 space-y-2">
                        <h3 class="text-lg font-semibold">{{ $movie->title }}</h3>
                        <p class="text-sm text-muted-foreground">{{ $movie->year ?? 'TBA' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section
        class="bg-secondary text-secondary-foreground rounded-xl p-8 flex flex-col items-center text-center space-y-4 shadow-md">
        <h3 class="text-2xl font-semibold">Stay Updated</h3>
        <p class="text-sm max-w-md">Subscribe to our newsletter for latest releases, ticket deals, and events.</p>
        <form action="#" method="POST" class="w-full max-w-sm flex gap-2">
            <input type="email" name="email" required
                class="flex-1 px-3 py-2 rounded-md border border-border bg-background text-foreground placeholder:text-muted-foreground"
                placeholder="Enter your email">
            <button type="submit"
                class="px-4 py-2 bg-primary text-primary-foreground rounded-md hover:opacity-90 transition">Subscribe</button>
        </form>
    </section>

    </main>

</x-layout>
