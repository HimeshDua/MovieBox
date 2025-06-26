<x-admin-layout title="Add New Show | Movie Box">
    <nav class="text-sm text-muted-foreground mb-6" aria-label="breadcrumb">
        <ol class="list-none p-0 inline-flex">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-primary">Dashboard</a><span
                    class="mx-2">/</span>
            </li>
            <li><a href="{{ route('admin.shows.index') }}" class="hover:text-primary">Shows</a><span
                    class="mx-2">/</span></li>
            <li class="text-foreground" aria-current="page">Add Show</li>
        </ol>
    </nav>

    <div class="bg-card border border-border rounded-xl p-8 shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-foreground">Create New Show</h2>

        <form action="{{ route('admin.shows.store') }}" method="POST" class="space-y-6">
            @csrf

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
                {{-- Movie --}}
                <div>
                    <label class="block text-sm font-medium mb-2 text-muted-foreground">Select Movie <span
                            class="text-red-500">*</span></label>
                    <select name="movie_id" required
                        class="w-full bg-background border border-border rounded-lg py-2 px-3 text-foreground focus:ring-2 focus:ring-primary">
                        <option disabled selected>-- Select Movie --</option>
                        @foreach ($movies as $movie)
                            <option value="{{ $movie->id }}" @selected(old('movie_id') == $movie->id)>
                                {{ $movie->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Show Class --}}
                <div>

                    <label class="block text-sm font-medium mb-2 text-muted-foreground">Class<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="class" value="{{ old('class') }}"
                        class="w-full bg-background border border-border rounded-lg py-2 px-3 text-foreground focus:ring-2 focus:ring-primary"
                        placeholder="e.g., Silver, Gold, Platinum" required />
                </div>

                {{-- City --}}
                <div>
                    <label class="block text-sm font-medium mb-2 text-muted-foreground">City <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full bg-background border border-border rounded-lg py-2 px-3 text-foreground focus:ring-2 focus:ring-primary"
                        placeholder="e.g., Lahore" required />
                </div>

                {{-- Location --}}
                <div>
                    <label class="block text-sm font-medium mb-2 text-muted-foreground">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        class="w-full bg-background border border-border rounded-lg py-2 px-3 text-foreground focus:ring-2 focus:ring-primary"
                        placeholder="e.g., Packages Mall" />
                </div>

                {{-- Date --}}
                <div>
                    <label class="block text-sm font-medium mb-2 text-muted-foreground">Show Date <span
                            class="text-red-500">*</span></label>
                    <input type="date" name="show_date" value="{{ old('show_date') }}"
                        class="w-full bg-background border border-border rounded-lg py-2 px-3 text-foreground focus:ring-2 focus:ring-primary"
                        required />
                </div>

                {{-- Time --}}
                <div>
                    <label class="block text-sm font-medium mb-2 text-muted-foreground">Show Time <span
                            class="text-red-500">*</span></label>
                    <input type="time" name="show_time" value="{{ old('show_time') }}"
                        class="w-full bg-background border border-border rounded-lg py-2 px-3 text-foreground focus:ring-2 focus:ring-primary"
                        required />
                </div>


            </div>

            <button type="submit" class="btn btn-primary w-full text-base">
                Create Show
            </button>
        </form>
    </div>
</x-admin-layout>
