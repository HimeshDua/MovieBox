<x-layout>
    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-10 space-y-10">

        <div>
            <a href="{{ route('movies.index') }}"
                class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Movies
            </a>
        </div>

        <div
            class="flex flex-col md:flex-row gap-8 bg-card text-card-foreground border border-border rounded-2xl shadow-sm p-6">

            <div class="w-full md:w-64 h-96 bg-muted rounded-md overflow-hidden">
                @if ($movie->poster)
                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover" />
                @else
                    <div
                        class="w-full h-full flex items-center justify-center text-muted-foreground text-sm font-medium">
                        No Poster
                    </div>
                @endif
            </div>

            <div class="flex-1 space-y-4">
                <h1 class="text-3xl font-bold text-primary">{{ $movie->title }}</h1>

                <p class="text-sm text-muted-foreground leading-relaxed">
                    {{ $movie->description }}
                </p>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm text-muted-foreground pt-2">
                    <p><span class="font-medium text-foreground">Category:</span> {{ $movie->category ?? 'General' }}
                    </p>
                    <p><span class="font-medium text-foreground">Language:</span> {{ $movie->language ?? 'English' }}
                    </p>
                    <p><span class="font-medium text-foreground">Duration:</span> {{ $movie->duration ?? 'N/A' }} min
                    </p>
                    <p><span class="font-medium text-foreground">Release Year:</span> {{ $movie->year ?? 'TBA' }}</p>
                    <p><span class="font-medium text-foreground">Rating:</span> ⭐ {{ $movie->rating }}/10</p>
                </div>

                @if ($movie->link)
                    <div class="pt-4">
                        <a href="{{ $movie->link }}" target="_blank"
                            class="inline-block px-5 py-2 bg-primary text-primary-foreground rounded-md hover:opacity-90 transition">
                            Watch Trailer
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if ($movie->shows->count())
            <div class="mt-8 space-y-4">
                <h2 class="text-xl font-semibold text-foreground">Available Shows</h2>

                <ul class="grid gap-4 sm:grid-cols-2">
                    @foreach ($movie->shows as $show)
                        <li class="bg-muted rounded-[--radius] p-4 border border-border text-muted-foreground">
                            <p><strong class="text-foreground">Platform:</strong> {{ $show->platform }}</p>
                            <p><strong class="text-foreground">City:</strong> {{ $show->city }}</p>
                            <p><strong class="text-foreground">Location:</strong> {{ $show->location ?? 'N/A' }}</p>
                            <p><strong class="text-foreground">Date:</strong>
                                {{ \Carbon\Carbon::parse($show->show_date)->format('M d, Y') }}</p>
                            <p><strong class="text-foreground">Time:</strong>
                                {{ \Carbon\Carbon::parse($show->show_time)->format('h:i A') }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif


    </main>
</x-layout>
