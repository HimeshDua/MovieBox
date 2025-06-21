<x-layout>
    <main class="max-w-5xl flex flex-col gap-y-6 mx-auto px-4 sm:px-6">

        <h1 class="text-4xl font-bold mb-6 text-center text-primary">List of Movies</h1>

        <ul class="flex flex-col gap-6">
            @foreach ($movies as $movie)
                <li>
                    <div class="flex flex-col sm:flex-row items-stretch bg-card text-card-foreground border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">

                        <div class="w-full sm:w-40 h-60 sm:h-auto bg-muted overflow-hidden">
                            @if ($movie->poster)
                                <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover" />
                            @else
                                <div class="w-full h-full flex items-center justify-center text-muted-foreground text-sm font-medium bg-muted">
                                    No Poster
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col justify-between flex-1 p-5 space-y-3">
                            <div class="space-y-2">
                                <h2 class="text-2xl font-semibold leading-tight text-foreground">{{ $movie->title }}</h2>

                                <p class="text-sm text-muted-foreground line-clamp-2">
                                    {{ $movie->description }}
                                </p>

                                <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-muted-foreground">
                                    <p><span class="font-medium text-foreground">Category:</span> {{ $movie->category ?? 'General' }}</p>
                                    <p><span class="font-medium text-foreground">Language:</span> {{ $movie->language ?? 'English' }}</p>
                                    <p><span class="font-medium text-foreground">Year:</span> {{ $movie->year ?? '2024' }}</p>
                                    <p><span class="font-medium text-foreground">Duration:</span> {{ $movie->duration ?? '120' }} min</p>
                                </div>
                            </div>

                            <div class="pt-2">
                                <span class="inline-block text-sm font-medium text-yellow-500">
                                    ⭐ {{ $movie->rating }}/10
                                </span>
                            </div>
                        </div>

                    </div>
                </li>
            @endforeach
        </ul>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $movies->links() }}
        </div>

    </main>
</x-layout>
