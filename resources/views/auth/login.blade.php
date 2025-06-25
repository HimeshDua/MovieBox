<x-layout>
    <x-slot:title>
        Log In - Movie Box
    </x-slot>
    <div class="max-w-md mx-auto mt-10 bg-card p-6 rounded-xl shadow-md space-y-6">

        <h1 class="text-2xl font-bold text-center">Log In</h1>

        @if ($errors->any())
            <div class="bg-destructive/10 border border-destructive text-destructive text-sm p-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="space-y-1">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-3 py-2 border rounded-md bg-background text-foreground border-input focus:outline-none focus:ring-2 focus:ring-ring">
            </div>

            <div class="space-y-1">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border rounded-md bg-background text-foreground border-input focus:outline-none focus:ring-2 focus:ring-ring">
            </div>

            <button type="submit"
                class="w-full py-2 px-4 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition">
                Log In
            </button>
        </form>
    </div>
</x-layout>
