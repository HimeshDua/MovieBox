<x-layout :title="$title" :section_title="$movie->title">

    <nav class="text-sm text-muted-foreground mb-6" aria-label="breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="/" class="hover:text-primary transition-colors">Home</a>
                <span class="mx-2">/</span>
            </li>
            <li class="flex items-center">
                <a href="{{ route('movies.index') }}" class="hover:text-primary transition-colors">Movies</a>
                <span class="mx-2">/</span>
            </li>
            <li class="flex items-center">
                <span class="text-foreground" aria-current="page">{{ $movie->title }}</span>
            </li>
        </ol>
    </nav>

    {{-- Hero Section: Movie Poster & Details --}}
    <section
        class="bg-card border border-border rounded-2xl shadow-lg p-8 flex flex-col md:flex-row items-start gap-8 mb-10">
        {{-- Poster --}}
        <div class="w-full md:w-80 h-auto md:h-[450px] bg-muted rounded-xl overflow-hidden flex-shrink-0 shadow-md">
            @if ($movie->poster)
                <img src="{{ $movie->poster }}" alt="{{ $movie->title }} Poster" class="w-full h-full object-cover"
                    loading="lazy" />
            @else
                <div class="w-full h-full flex items-center justify-center text-muted-foreground text-lg font-medium">
                    No Poster Available
                </div>
            @endif
        </div>

        {{-- Details --}}
        <div class="flex-1 flex flex-col justify-between h-full">
            <div class="space-y-5">
                <h1 class="text-4xl font-extrabold text-primary leading-tight">{{ $movie->title }}</h1>
                <p class="text-md text-muted-foreground leading-relaxed">
                    {{ $movie->description ?? 'No description available for this movie yet.' }}
                </p>

                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-3 text-sm text-muted-foreground">
                    <p><span class="font-semibold text-foreground">Category:</span> {{ $movie->category ?? 'General' }}
                    </p>
                    <p><span class="font-semibold text-foreground">Language:</span> {{ $movie->language ?? 'English' }}
                    </p>
                    <p><span class="font-semibold text-foreground">Duration:</span>
                        {{ $movie->duration ? $movie->duration . ' min' : 'N/A' }}</p>
                    <p><span class="font-semibold text-foreground">Year:</span> {{ $movie->year ?? 'TBA' }}</p>
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-500 text-xl">⭐</span>
                        <span
                            class="text-lg font-bold text-foreground">{{ number_format($movie->rating, 1) ?? 'N/A' }}/10</span>
                    </div>
                </div>
            </div>

            @if ($movie->link)
                <a href="{{ $movie->link }}" target="_blank" rel="noopener noreferrer"
                    class="mt-8 inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-primary-foreground bg-primary hover:bg-primary/90 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 mr-2">
                        <path
                            d="M2.25 18.75a60.07 60.07 0 0 1 15.795 2.104c.207.093.344-.006.32-.223A8.96 8.96 0 0 0 18 6.477V4.243c0-1.077-.99-1.666-1.933-1.085L4.785 8.1A.75.75 0 0 0 4 8.854v5.392a4.5 4.5 0 0 0 2.25 3.894M18 4.243v4.471l4.172-2.39a.75.75 0 0 0 0-1.282L18 4.243Z" />
                    </svg>
                    Watch Full Movie
                </a>
            @endif
        </div>
    </section>

    @if ($movie->trailer_url)
        <section class="bg-card border border-border rounded-2xl shadow-lg overflow-hidden mb-10">
            <h2 class="px-6 pt-6 text-2xl font-bold text-foreground mb-4">Official Trailer</h2>
            <div class="aspect-video w-full bg-black">
                <iframe src="{{ $movie->trailer_url }}" title="{{ $movie->title }} Official Trailer"
                    class="w-full h-full" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen loading="lazy">
                </iframe>
            </div>
        </section>
    @endif

    {{-- Available Shows --}}
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-foreground mb-5">Available Shows</h2>

        @if ($movie->shows->isEmpty())
            <p class="text-md text-muted-foreground bg-muted p-4 rounded-lg border border-border">
                No shows are scheduled for this movie yet. Please check back later!
            </p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($movie->shows as $show)
                    <div
                        class="bg-card rounded-xl p-5 border border-border shadow-sm transition-transform duration-200 hover:scale-[1.02] hover:shadow-md">
                        <p class="text-lg font-semibold text-foreground mb-2">{{ $show->platform }}</p>
                        <div class="text-sm text-muted-foreground space-y-1">
                            <p><span class="font-medium text-foreground">City:</span> {{ $show->city }}</p>
                            <p><span class="font-medium text-foreground">Location:</span>
                                {{ $show->location ?? 'N/A' }}</p>
                            <p><span class="font-medium text-foreground">Date:</span>
                                {{ \Carbon\Carbon::parse($show->show_date)->format('M d, Y') }}</p>
                            <p><span class="font-medium text-foreground">Time:</span>
                                {{ \Carbon\Carbon::parse($show->show_time)->format('h:i A') }}</p>
                        </div>
                        {{-- Add a "Book Now" button if applicable --}}
                        {{-- <a href="#" class="mt-4 inline-block text-center py-2 px-4 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors text-sm">Book Now</a> --}}
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    ---

    {{-- Review Section --}}
    <section class="mb-10">
        <h2 class="text-2xl font-bold text-foreground mb-5">Reviews ({{ $movie->reviews->count() }})</h2>

        @auth
            <div class="bg-card border border-border rounded-2xl shadow-sm p-6 mb-8">
                <h3 class="text-xl font-semibold text-foreground mb-4">Leave Your Review</h3>
                <form method="POST" action="{{ route('reviews.store') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">

                    @if ($errors->any())
                        <div class="bg-destructive/10 border border-destructive text-destructive text-sm p-4 rounded-lg">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="rating" class="block text-sm font-medium text-muted-foreground mb-2">Your
                                Rating</label>
                            <select name="rating" id="rating" required
                                class="mt-1 block w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                                <option value="">Select a rating</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                        {{ $i }} / 10</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="comment" class="block text-sm font-medium text-muted-foreground mb-2">Your
                                Comment</label>
                            <textarea name="comment" id="comment" rows="4" required
                                class="mt-1 block w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors resize-y"
                                placeholder="Share your thoughts about the movie...">{{ old('comment') }}</textarea>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                        Submit Review
                    </button>
                </form>
            </div>
        @else
            <p class="text-md text-muted-foreground bg-muted p-4 rounded-lg border border-border mb-8">
                <a href="{{ route('signin') }}" class="text-primary hover:underline font-medium">Sign in</a> to leave a
                review for this movie.
            </p>
        @endauth

        {{-- Reviews List --}}
        @if ($movie->reviews->isEmpty())
            <p class="text-md text-muted-foreground bg-muted p-4 rounded-lg border border-border">
                No reviews have been posted yet. Be the first to share your opinion!
            </p>
        @else
            <div class="space-y-6">
                @foreach ($movie->reviews as $review)
                    <div class="border border-border rounded-lg p-5 bg-card shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-3">
                            <span class="font-bold text-foreground text-lg">{{ $review->user->name }}</span>
                            <span class="text-yellow-500 text-md font-medium mt-1 sm:mt-0">
                                ⭐ {{ number_format($review->rating, 1) }}/10
                            </span>
                        </div>
                        <p class="text-foreground leading-relaxed">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

</x-layout>
