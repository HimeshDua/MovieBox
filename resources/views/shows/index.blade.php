<x-layout>
    <x-slot:title>
        Shows | MovieBox
    </x-slot>

    <x-slot:section_title>
        Book Your Show
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($shows as $show)
            <form action="{{ route('bookings.store') }}" method="POST"
                class="bg-card rounded-xl p-5 border border-border shadow-sm space-y-4 {{ Auth::check() ? '' : 'pointer-events-none opacity-50' }}">
                @csrf
                <input type="hidden" name="show_id" value="{{ $show->id }}">

                {{-- Movie Title --}}
                <h3 class="text-xl font-semibold text-foreground mb-2">🎬 {{ $show->movie->title }}</h3>

                {{-- Show Details --}}
                <div class="text-sm text-muted-foreground space-y-1">
                    <p><span class="font-medium text-foreground">City:</span> {{ $show->city }}</p>
                    <p><span class="font-medium text-foreground">Location:</span> {{ $show->location ?? 'N/A' }}</p>
                    <p><span class="font-medium text-foreground">Date:</span>
                        {{ \Carbon\Carbon::parse($show->show_date)->format('M d, Y') }}</p>
                    <p><span class="font-medium text-foreground">Time:</span>
                        {{ \Carbon\Carbon::parse($show->show_time)->format('h:i A') }}</p>
                </div>

                {{-- Class Selection --}}
                <div>
                    <label for="class_type" class="block text-sm font-medium text-muted-foreground mb-1">Select
                        Class</label>
                    <select name="class_type" id="class_type"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3">
                        <option value="Silver">Silver - Rs {{ $show->price_silver }}</option>
                        <option value="Gold">Gold - Rs {{ $show->price_gold }}</option>
                        <option value="Platinum">Platinum - Rs {{ $show->price_platinum }}</option>
                    </select>
                </div>

                {{-- Quantity --}}
                <div>
                    <label for="quantity" class="block text-sm font-medium text-muted-foreground mb-1">Tickets</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1"
                        class="w-full rounded-lg border border-border bg-background text-foreground py-2 px-3" required>
                </div>

                {{-- Kid Option --}}
                <label class="inline-flex items-center space-x-2 text-sm text-muted-foreground">
                    <input type="checkbox" name="is_kid" class="rounded border-border">
                    <span>Booking for a kid (3–12 years)?</span>
                </label>

                {{-- Submit Button --}}
                @auth
                    <button type="submit" class="btn btn-primary w-full">Book Now</button>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-full text-center">Login to Book</a>
                @endauth
            </form>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $shows->links() }}
    </div>
</x-layout>
