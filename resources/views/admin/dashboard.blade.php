<x-admin-layout :title="'Admin Dashboard'">
    <section class="space-y-6">
        {{-- Page Heading --}}
        <div class="flex items-center justify-between border-b border-border pb-4">
            <h1 class="text-2xl font-bold text-foreground">Admin Dashboard</h1>
            <span class="text-sm text-muted-foreground">Welcome back, {{ Auth::user()->name }} 👋</span>
        </div>

        {{-- Stats Cards --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-card border border-border rounded-xl shadow-sm p-6">
                <p class="text-sm text-muted-foreground">Total Movies</p>
                <h2 class="text-3xl font-bold text-primary mt-2">{{ $moviesCount }}</h2>
            </div>

            <div class="bg-card border border-border rounded-xl shadow-sm p-6">
                <p class="text-sm text-muted-foreground">Registered Users</p>
                <h2 class="text-3xl font-bold text-primary mt-2">{{ $usersCount }}</h2>
            </div>

            <div class="bg-card border border-border rounded-xl shadow-sm p-6">
                <p class="text-sm text-muted-foreground">Total Shows</p>
                <h2 class="text-3xl font-bold text-primary mt-2">{{ $showsCount }}</h2>
            </div>
        </div>

        {{-- Quick Actions  pleae work --}}
        {{-- blahb blah blh --}}
        <div class="mt-10 space-y-4">
            <h2 class="text-lg font-semibold text-foreground">Quick Actions</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">➕ Add Movie</a>
                <a href="{{ route('admin.shows.create') }}" class="btn btn-primary">🎬 Add Show</a>
                <a href="{{ route('admin.movies.index') }}" class="btn btn-outline">📂 Manage Movies</a>
                <a href="{{ route('admin.shows.index') }}" class="btn btn-outline">🗓️ Manage Shows</a>
                {{-- TODO: Add routes for user management if needed --}}
            </div>
        </div>
    </section>
</x-admin-layout>
