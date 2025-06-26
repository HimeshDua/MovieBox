<x-admin-layout title="Movies | Movie Box">
    {{-- Breadcrumb --}}
    <nav class="text-sm text-muted-foreground mb-6" aria-label="breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
                <span class="mx-2">/</span>
            </li>
            <li class="flex items-center">
                <span class="text-foreground" aria-current="page">Movies</span>
            </li>
        </ol>
    </nav>

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-foreground">All Movies</h2>
        <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">
            + Add New Movie
        </a>
    </div>

    @if ($movies->count())
        <div class="overflow-x-auto bg-card border border-border rounded-xl shadow-sm">
            <table class="w-full table-auto text-sm text-left">
                <thead class="bg-muted text-muted-foreground">
                    <tr>
                        <th class="px-4 py-3">Poster</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Language</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3">Year</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                        <tr class="border-t border-border hover:bg-muted/50 transition-colors">
                            <td class="px-4 py-3">
                                <img src="{{ asset($movie->poster ?? 'placeholder.jpg') }}" alt="{{ $movie->title }}"
                                    class="w-14 h-20 object-cover rounded-md shadow-sm">
                            </td>
                            <td class="px-4 py-3 font-medium text-foreground">{{ $movie->title }}</td>
                            <td class="px-4 py-3">{{ $movie->category }}</td>
                            <td class="px-4 py-3">{{ $movie->language }}</td>
                            <td class="px-4 py-3">{{ $movie->rating }}/10</td>
                            <td class="px-4 py-3">{{ $movie->year }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('admin.movies.edit', $movie->slug) }}"
                                    class="btn btn-outline text-xs">Edit</a>

                                <form action="{{ route('admin.movies.destroy', $movie->slug) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-destructive text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $movies->links() }}
        </div>
    @else
        <div class="text-center text-muted-foreground mt-12">
            <p>No movies added yet.</p>
        </div>
    @endif
</x-admin-layout>
