<x-layout title="Add New Movie | Movie Box" section_title="Add New Movie">

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
                <span class="text-foreground" aria-current="page">Add New Movie</span>
            </li>
        </ol>
    </nav>

    <h1>wow</h1>
    <div class=" bg-card border border-border rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-foreground mb-6">Enter Movie Details</h2>

        <form action="{{ route('movies.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="bg-destructive/10 border border-destructive text-destructive text-sm p-4 rounded-lg">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-muted-foreground mb-2">Movie Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('title') }}" required placeholder="e.g., The Matrix">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-muted-foreground mb-2">Category</label>
                    <input type="text" name="category" id="category"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('category') }}" placeholder="e.g., Sci-Fi, Action">
                </div>
                <div>
                    <label for="language" class="block text-sm font-medium text-muted-foreground mb-2">Language</label>
                    <input type="text" name="language" id="language"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('language') }}" placeholder="e.g., English, Hindi">
                </div>
                <div>
                    <label for="duration" class="block text-sm font-medium text-muted-foreground mb-2">Duration
                        (minutes)</label>
                    <input type="number" name="duration" id="duration"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('duration') }}" placeholder="e.g., 140">
                </div>
                <div>
                    <label for="year" class="block text-sm font-medium text-muted-foreground mb-2">Release
                        Year</label>
                    <input type="number" name="year" id="year"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('year') }}" placeholder="e.g., 1999">
                </div>
                <div>
                    <label for="rating" class="block text-sm font-medium text-muted-foreground mb-2">Rating (out of
                        10) <span class="text-red-500">*</span></label>
                    <input type="number" name="rating" id="rating" step="0.1" min="0" max="10"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('rating') }}" required placeholder="e.g., 8.7">
                </div>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-muted-foreground mb-2">Description <span
                        class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="5"
                    class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors resize-y"
                    required placeholder="Provide a brief synopsis of the movie...">{{ old('description') }}</textarea>
            </div>

            {{-- Links and Media --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="link" class="block text-sm font-medium text-muted-foreground mb-2">Full Movie Link
                        (Optional)</label>
                    <input type="url" name="link" id="link"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('link') }}" placeholder="e.g., https://example.com/movie-watch-link">
                    <p class="mt-1 text-xs text-muted-foreground">Link to watch the full movie on an external site.</p>
                </div>
                <div>
                    <label for="trailer_url" class="block text-sm font-medium text-muted-foreground mb-2">Trailer URL
                        (YouTube Embed) <span class="text-red-500">*</span></label>
                    <input type="url" name="trailer_url" id="trailer_url"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3 focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                        value="{{ old('trailer_url') }}" required
                        placeholder="e.g., https://www.youtube.com/embed/dQw4w9WgXcQ">
                    <p class="mt-1 text-xs text-muted-foreground">Please use the YouTube embed URL (e.g.,
                        `youtube.com/embed/VIDEO_ID`).</p>
                </div>
            </div>

            {{-- Poster Upload --}}
            <div>
                <label for="poster" class="block text-sm font-medium text-muted-foreground mb-2">Movie Poster
                    (Upload Image)</label>
                <input type="file" name="poster" id="poster" accept="image/*"
                    class="block w-full text-sm text-foreground
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-primary file:text-primary-foreground
                    hover:file:bg-primary/90 transition-colors cursor-pointer"
                    onchange="document.getElementById('poster-preview').src = window.URL.createObjectURL(this.files[0])">
                <p class="mt-1 text-xs text-muted-foreground">Recommended: High-resolution image (e.g., JPG, PNG).</p>
                <div
                    class="mt-4 w-48 h-auto bg-muted rounded-lg overflow-hidden flex items-center justify-center border border-border shadow-sm">
                    <img id="poster-preview" src="{{ asset('path/to/default-placeholder.jpg') }}"
                        alt="Poster Preview" class="w-full h-full object-cover">
                    <span id="poster-placeholder" class="text-muted-foreground text-sm p-4 hidden">No image
                        selected</span>
                </div>
                <script>
                    document.getElementById('poster').addEventListener('change', function() {
                        const preview = document.getElementById('poster-preview');
                        const placeholder = document.getElementById('poster-placeholder');
                        if (this.files && this.files[0]) {
                            preview.src = URL.createObjectURL(this.files[0]);
                            preview.onload = function() {
                                URL.revokeObjectURL(preview.src); // free up memory
                            }
                            preview.classList.remove('hidden');
                            placeholder.classList.add('hidden');
                        } else {
                            preview.src = "{{ asset('path/to/default-placeholder.jpg') }}"; // Or a data URL for a blank image
                            preview.classList.add('hidden');
                            placeholder.classList.remove('hidden');
                        }
                    });
                    // Initialize if there's no file by default (hide preview, show placeholder)
                    if (!document.getElementById('poster').files[0]) {
                        document.getElementById('poster-preview').classList.add('hidden');
                        document.getElementById('poster-placeholder').classList.remove('hidden');
                    }
                </script>
            </div>


            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-3 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90 transition-colors duration-200 ease-in-out font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Add Movie
            </button>
        </form>
    </div>

</x-layout>
