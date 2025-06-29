<x-layout>
    <x-slot:title>
        Profile Page - MovieBox
    </x-slot>

    <x-slot:section_title>
        👤 Your Profile
    </x-slot>

    <div class="space-y-10">

        {{-- Account Info --}}
        <section class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-foreground mb-4">👤 Account Information</h2>
            <div class="space-y-2 text-sm text-muted-foreground">
                <p><span class="font-medium text-foreground">Name:</span> {{ auth()->user()->name }}</p>
                <p><span class="font-medium text-foreground">Email:</span> {{ auth()->user()->email }}</p>
                <p><span class="font-medium text-foreground">Joined:</span>
                    {{ auth()->user()->created_at->format('M d, Y') }}</p>
            </div>
        </section>

        {{-- Booked Shows --}}
        <section class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-foreground mb-4">🎟️ Booked Shows</h2>

            @if ($bookings->count())
                <div class="space-y-6">
                    @foreach ($bookings as $booking)
                        <div class="border border-border rounded-lg p-4 text-sm text-muted-foreground space-y-1">
                            <p><span class="font-medium text-foreground">Movie:</span>
                                {{ $booking->show->movie->title }}</p>
                            <p><span class="font-medium text-foreground">City:</span> {{ $booking->show->city }}</p>
                            <p><span class="font-medium text-foreground">Date:</span>
                                {{ \Carbon\Carbon::parse($booking->show->show_date)->format('M d, Y') }}</p>
                            <p><span class="font-medium text-foreground">Time:</span>
                                {{ \Carbon\Carbon::parse($booking->show->show_time)->format('h:i A') }}</p>
                            <p><span class="font-medium text-foreground">Class:</span> {{ $booking->class_type }}</p>
                            <p><span class="font-medium text-foreground">Is Kid:</span>
                                {{ $booking->is_kid ? 'Yes' : 'No' }}</p>
                            <p><span class="font-medium text-foreground">Tickets:</span> {{ $booking->quantity }}</p>
                            <p><span class="font-medium text-foreground">Total Paid:</span> Rs
                                {{ $booking->total_price }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-muted-foreground">You haven’t booked any shows yet.</p>
            @endif
        </section>

        {{-- Movie Reviews --}}
        <section class="bg-card border border-border rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-foreground mb-4">💬 Your Reviews</h2>

            @if ($reviews->count())
                <div class="space-y-6">
                    @foreach ($reviews as $review)
                        <div class="border border-border rounded-lg p-4 text-sm text-muted-foreground space-y-1">
                            <p><span class="font-medium text-foreground">Movie:</span> {{ $review->movie->title }}</p>
                            <p><span class="font-medium text-foreground">Rating:</span> {{ $review->rating }}/10</p>
                            <p><span class="font-medium text-foreground">Comment:</span> {{ $review->comment }}</p>
                            <p><span class="font-medium text-foreground">Reviewed On:</span>
                                {{ $review->created_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-muted-foreground">No reviews posted yet.</p>
            @endif
        </section>

    </div>
</x-layout>
