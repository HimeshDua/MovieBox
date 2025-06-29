<x-layout>
    <x-slot:title>
        MovieBox | Book Tickets Online
    </x-slot>

    <section class="relative bg-primary text-primary-foreground py-20 px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">Welcome to MovieBox</h1>
        <p class="text-lg md:text-xl mb-8">Watch trailers, explore movies, and book your favorite shows with ease.</p>
        <a href="{{ route('shows.index') }}" class="btn btn-secondary">🎟 Browse Shows</a>
    </section>

    <section class="py-16 px-6 bg-background">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-foreground">🎬 Now Showing</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($nowShowing as $movie)
                    <div
                        class="group bg-card rounded-xl shadow-md overflow-hidden border border-border hover:shadow-lg transition duration-200">
                        <div class="relative">
                            <img src="{{ asset('/posters/' . ($movie->poster ?? 'placeholder.png')) }}"
                                alt="{{ $movie->title }}"
                                class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-[1.02]" />
                            <div
                                class="absolute top-2 left-2 bg-primary text-primary-foreground text-xs font-medium px-2 py-1 rounded">
                                ⭐ {{ $movie->rating }}/10
                            </div>
                        </div>

                        <div class="p-4 space-y-2">
                            <h3 class="text-lg font-semibold text-foreground">{{ $movie->title }}</h3>
                            <p class="text-sm text-muted-foreground line-clamp-2">
                                {{ Str::limit($movie->description, 90) }}
                            </p>

                            <div class="flex justify-between items-center pt-2">
                                <span class="text-xs text-muted-foreground">
                                    {{ $movie->duration ?? 120 }} min · {{ $movie->language ?? 'English' }}
                                </span>
                                <a href="{{ route('movies.detail', $movie->slug) }}"
                                    class="text-sm text-primary hover:underline font-medium">Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($topRatedMovies->count())
        <section class="py-16 px-6 bg-muted/20">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold mb-6 text-foreground">🔥 Top Rated Movies</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($topRatedMovies as $movie)
                        <div
                            class="group bg-card rounded-xl shadow-md overflow-hidden border border-border hover:shadow-lg transition duration-200">
                            <div class="relative">
                                <img src="{{ asset('/posters/' . ($movie->poster ?? 'placeholder.png')) }}"
                                    alt="{{ $movie->title }}"
                                    class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-[1.02]" />
                                <div
                                    class="absolute top-2 left-2 bg-primary text-primary-foreground text-xs font-medium px-2 py-1 rounded">
                                    ⭐ {{ $movie->rating }}/10
                                </div>
                            </div>

                            <div class="p-4 space-y-2">
                                <h3 class="text-lg font-semibold text-foreground">{{ $movie->title }}</h3>
                                <p class="text-sm text-muted-foreground line-clamp-2">
                                    {{ Str::limit($movie->description, 90) }}
                                </p>

                                <div class="flex justify-between items-center pt-2">
                                    <span class="text-xs text-muted-foreground">
                                        {{ $movie->duration ?? 120 }} min · {{ $movie->language ?? 'English' }}
                                    </span>
                                    <a href="{{ route('movies.detail', $movie->slug) }}"
                                        class="text-sm text-primary hover:underline font-medium">Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layout>
