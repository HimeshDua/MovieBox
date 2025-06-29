    <x-layout>

        <x-slot:title>
            Register - Movie Box
        </x-slot>

        <div class="max-w-md mx-auto mt-10 bg-card p-6 rounded-xl border border-gray-400/50 shadow-md space-y-6">

            <h1 class="text-3xl font-bold text-center my-2 text-primary tracking-tight">
                Register
            </h1>

            @if ($errors->any())
                <div class="bg-destructive/10 border border-destructive text-destructive text-sm p-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="space-y-1">
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-3 py-2 border rounded-md bg-background text-foreground border-input focus:outline-none focus:ring-2 focus:ring-ring">
                </div>

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

                <div class="space-y-1">
                    <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-3 py-2 border rounded-md bg-background text-foreground border-input focus:outline-none focus:ring-2 focus:ring-ring">
                </div>

                <button type="submit" class="w-full btn btn-primary">
                    Create Account
                </button>

            </form>

            <p class="text-center text-sm text-muted-foreground">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary hover:underline">Log in</a>
            </p>
        </div>
    </x-layout>
