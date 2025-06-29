<x-layout>
    <x-slot:title>
        Profile | MovieBox
    </x-slot>

    <x-slot:section_title>
        Your Profile
    </x-slot>

    <div class="space-y-12">

        {{-- User Info --}}
        <div class="bg-card border border-border rounded-xl p-6 shadow">
            <h2 class="text-xl font-semibold text-foreground mb-4">👤 Account Information</h2>
            <div class="text-muted-foreground text-sm space-y-1">
                <p><span class="font-medium text-foreground">Name:</span> {{ auth()->user()->name }}</p>
                <p><span class="font-medium text-foreground">Email:</span> {{ auth()->user()->email }}</p>
                <p><span class="font-medium text-foreground">Joined:</span>
                    {{ auth()->user()->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        {{-- Booked Shows --}}
        <div class="bg-card border border-border rounded-xl p-6 shadow">
            <h2 class="text-xl font-semibold text-foreground mb-4">🎟️ Booked Shows</h2>

            @if ($bookings->count())
                <ul class="space-y-4">
                    @foreach ($bookings as $booking)
                        <li class="border border-border rounded-lg p-4">
                            <div class="text-sm text-muted-foreground space-y-1">
                                <p><span class="font-medium text-foreground">Movie:</span>
                                    {{ $booking->show->movie->title }}</p>
                                <p><span class="font-medium text-foreground">City:</span> {{ $booking->show->city }}</p>
                                <p><span class="font-medium text-foreground">Date:</span>
                                    {{ \Carbon\Carbon::parse($booking->show->show_date)->format('M d, Y') }}</p>
                                <p><span class="font-medium text-foreground">Time:</span>
                                    {{ \Carbon\Carbon::parse($booking->show->show_time)->format('h:i A') }}</p>
                                <p><span class="font-medium text-foreground">Class:</span> {{ $booking->class_type }}
                                </p>
                                <p><span class="font-medium text-foreground">Tickets:</span> {{ $booking->quantity }}
                                </p>
                                <p><span class="font-medium text-foreground">Total Paid:</span> Rs
                                    {{ $booking->total_price }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-muted-foreground">You haven’t booked any shows yet.</p>
            @endif
        </div>

        {{-- Movie Reviews --}}
        <div class="bg-card border border-border rounded-xl p-6 shadow">
            <h2 class="text-xl font-semibold text-foreground mb-4">💬 Your Reviews</h2>

            @if ($reviews->count())
                <ul class="space-y-4">
                    @foreach ($reviews as $review)
                        <li class="border border-border rounded-lg p-4">
                            <div class="text-sm text-muted-foreground space-y-1">
                                <p><span class="font-medium text-foreground">Movie:</span> {{ $review->movie->title }}
                                </p>
                                <p><span class="font-medium text-foreground">Rating:</span> {{ $review->rating }}/10
                                </p>
                                <p><span class="font-medium text-foreground">Comment:</span> {{ $review->comment }}</p>
                                <p><span class="font-medium text-foreground">Reviewed On:</span>
                                    {{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-muted-foreground">No reviews posted yet.</p>
            @endif
        </div>
    </div>
</x-layout>
