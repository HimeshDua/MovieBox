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
                        <div
                            class="flex flex-col sm:flex-row items-stretch border border-border rounded-xl overflow-hidden bg-card shadow-sm hover:shadow-md transition-shadow duration-300">

                            {{-- Poster --}}
                            <div class="w-full sm:w-40 h-60 sm:h-auto bg-muted">
                                @if ($booking->show->movie->poster)
                                    <img src="{{ asset('/posters/' . $booking->show->movie->poster) }}"
                                        alt="{{ $booking->show->movie->title }}"
                                        class="w-full h-full object-cover rounded-none" />
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-muted-foreground text-sm font-medium bg-muted">
                                        No Poster
                                    </div>
                                @endif
                            </div>

                            {{-- Details --}}
                            <div
                                class="flex-1 p-5 flex flex-col justify-between space-y-3 text-sm text-muted-foreground">
                                <div class="space-y-1">
                                    <h3 class="text-lg font-semibold text-foreground">
                                        🎬 {{ $booking->show->movie->title }}
                                    </h3>

                                    <dl class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-1">
                                        <div>
                                            <dt class="font-medium text-foreground">City:</dt>
                                            <dd>{{ $booking->show->city }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-foreground">Date:</dt>
                                            <dd>{{ \Carbon\Carbon::parse($booking->show->show_date)->format('M d, Y') }}
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-foreground">Time:</dt>
                                            <dd>{{ \Carbon\Carbon::parse($booking->show->show_time)->format('h:i A') }}
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-foreground">Class:</dt>
                                            <dd>{{ $booking->class_type }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-foreground">Is Kid:</dt>
                                            <dd>{{ $booking->is_kid ? 'Yes' : 'No' }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-foreground">Tickets:</dt>
                                            <dd>{{ $booking->quantity }}</dd>
                                        </div>
                                        <div>
                                            <dt class="font-medium text-foreground">Total Paid:</dt>
                                            <dd>Rs {{ $booking->total_price }}</dd>
                                        </div>
                                    </dl>
                                </div>

                                <div class="pt-2">
                                    <a href="{{ route('movies.detail', $booking->show->movie->slug) }}"
                                        class="inline-flex items-center px-4 py-2 bg-primary text-primary-foreground text-xs font-medium rounded-radius hover:bg-primary/90 transition">
                                        🎟 View Movie Details
                                    </a>
                                </div>
                            </div>
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
